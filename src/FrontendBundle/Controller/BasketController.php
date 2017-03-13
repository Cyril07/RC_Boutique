<?php

namespace FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use BackendBundle\Entity\Product;
use BackendBundle\Entity\Basket;

/**
 * Basket controller.
 *
 * @Route("basket")
 */
class BasketController extends Controller
{
    /**
     * @Route("/add", name="basket_add")
     * @Method({"GET", "POST"})
     */ 

    public function addbasketAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $request_product_id = $request->request->get('product_id');
        $request_user_id = $request->request->get('user_id');

        $product = $em->getRepository("BackendBundle:Product")->find($request_product_id);
        $user = $em->getRepository("BackendBundle:User")->find($request_user_id);

        $basket = new Basket ();
        $basket->setProduct($product);
        $basket->setUser($user);
        $basket->setQuantity(1);

        $em->persist($basket);
        $em->flush($basket);

        return new Response();        
    }

    /**
     * @Route("/", name="basket")
     * @Method("GET")
     */

    public function basketAction()
    {
        $em = $this->getDoctrine()->getManager();
        $basket = $em->getRepository("BackendBundle:Basket")->findAll();

        return $this->render('FrontendBundle::shopping_cart.html.twig', array(
            'basket' => $basket,
        ));
    }
}