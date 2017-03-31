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
class Order_detailController extends Controller
{


/**
 * @Route("/add", name="order_detail_add")
 */
    
    public function addAction(Request $request){

        $em = $this->getDoctrine()->getManager();
        $product=$em->getRepository('BackendBundle:Product')->find($request->request->get('product_id'));
        $user=$em->getRepository('BackendBundle:User')->find($request->request->get('user_id'));
        if(!$product || !$user){

            return new Response("Pas de User ou de Produit",400);   
        }

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
            die('true');

        }
        else {

            //Création du panier pour le user
            $now= new \DateTime('now');
            $globalOrder = new GlobalOrder();
            $globalOrder->setUser($user);
            $globalOrder->setDateOrder($now);
            $em->persist($globalOrder);
            $em->flush();

            die('false');
        }


    }

    /**
     * @Route("/", name="order_detail")
     * @Method("GET")
     */

    public function order_detailAction()
    {   
        $em = $this->getDoctrine()->getManager();

        $securityContext = $this->container->get('security.authorization_checker');

        if ($securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED')) {

            $user = $this->get('security.token_storage')->getToken()->getUser()->getId();

            $globalOrder = $em->getRepository("BackendBundle:GlobalOrder")->hasBasket($user);

            
            return $this->render('FrontendBundle::shopping_cart.html.twig', array(
                'globalOrder' => $globalOrder,
            ));
        }

        return $this->render('FrontendBundle::shopping_cart.html.twig');
    }


    /**
     * @Route("/delete", name="order_detail_delete")
     * @Method({"GET", "POST"})
     */ 

    public function deleteOrder_detailAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $request_order_detail_id = $request->request->get('order_detail_id');
        $request_user_id = $request->request->get('user_id');
        //echo $request_order_id;die;
        $order_detail = $em->getRepository("BackendBundle:Order_detail")->find($request_order_detail_id);
        $user = $em->getRepository("BackendBundle:User")->find($request_user_id);

        $em->remove($order_detail);
        $em->flush();

        return new Response();        
    }

    /**
     * @Route("/quantity_order_detail", name="quantity_order_detail")
     * @Method({"GET", "POST"})
     */ 

    public function quantityOrder_detailAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $quantity = $request->request->get('quantity');
        
        $order_detail = $em->getRepository("BackendBundle:Order_detail")->find($request->request->get('order_detail_id'));
        
        $order_detail->setQuantity($quantity);
        
        $em->persist($order_detail);
        $em->flush();
        
        
        return new Response();
    }
}