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
            $totalPrice = 0;
            if ($globalOrder){
                $totalPrice = $em->getRepository("BackendBundle:Order_detail")->total_global_order($globalOrder->getId());
            }
            
            return $this->render('FrontendBundle::shopping_cart.html.twig', array(
                'globalOrder' => $globalOrder,
                'totalPrice' => $totalPrice[1],
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

        $totalPrice = $em->getRepository("BackendBundle:Order_detail")->total_global_order($order_detail->getGlobalOrder()->getId());
        
        
        return new Response(json_encode($totalPrice));
    }


}