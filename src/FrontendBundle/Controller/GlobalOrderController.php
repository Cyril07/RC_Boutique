<?php

namespace FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use BackendBundle\Entity\Product;
use BackendBundle\Entity\Order_detail;
use BackendBundle\Entity\GlobalOrder;

/**
 * Order controller.
 *
 * @Route("panier")
 */
class GlobalOrderController extends Controller
{


/**
 * @Route("/add", name="order_detail_add")
 */
    
    public function addAction(Request $request){

        $em = $this->getDoctrine()->getManager();
        $product=$em->getRepository('BackendBundle:Product')->find($request->request->get('product_id'));
        $user=$em->getRepository('BackendBundle:User')->find($request->request->get('user_id'));
        /*
        if(!$product || !$user){

            return new Response("Pas de User ou de Produit",400);   
        }
*/
        //Vérification si le user a un panier

        if ($globalOrder = $em->getRepository('BackendBundle:GlobalOrder')->hasBasket($user)) {
            if ($order_detail = $em->getRepository('BackendBundle:Order_detail')->isInBasket($globalOrder, $product)){

                $order_detail->incQuantity();

            }

            else {
                $order_detail = new Order_detail();
                $order_detail->setProduct($product);
                $order_detail->setQuantity(1);
                $order_detail->setGlobalOrder($globalOrder);
            }

            $em->persist($order_detail);
            $em->flush();            

        }

        else {
            //Création du panier pour le user
            $now= new \DateTime('now');

            $globalOrder = new GlobalOrder();
            $globalOrder->setUser($user);
            $globalOrder->setDateOrder($now);
            $em->persist($globalOrder);
   
            //En ajoutant le produit selectionné
            $order_detail = new Order_detail();
            $order_detail->setProduct($product);
            $order_detail->setQuantity(1);
            $order_detail->setGlobalOrder($globalOrder);
            $em->persist($order_detail);
            $em->flush();

        }
        return new Response();

    }

    /**
     * @Route("/delete_order/{id}", name="delete_order")
     * @Method({"GET", "POST"})
     */ 

    public function deleteOrderAction(GlobalOrder $globalOrder)
    {
        $em = $this->getDoctrine()->getManager();

        $em->remove($globalOrder);
        $em->flush();       
        
        return $this->redirectToRoute('order_detail');
        
    }


    /**
     * @Route("/confirmation", name="confirmed_order")
     * @Method({"GET", "POST"})
     */ 

    public function confirmOrderAction()
    {
        $em = $this->getDoctrine()->getManager();

        $user = $this->get('security.token_storage')->getToken()->getUser()->getId();

        $globalOrder = $em->getRepository("BackendBundle:GlobalOrder")->hasBasket($user);

        return $this->render('FrontendBundle::summary_order.html.twig', array(
            'globalOrder' => $globalOrder,
        ));
        
    }

    private function global_order_detail($global_order_id){

        $em = $this->getDoctrine()->getManager();

        $tot = $em->getRepository('BackendBundle:GlobalOrder')->total_global_order($global_order_id);

        return $this->render('FrontendBundle::summary_order.html.twig', array(
            'tot' => $tot,
        ));

    }

}