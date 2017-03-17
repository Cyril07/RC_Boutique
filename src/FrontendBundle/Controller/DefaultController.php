<?php

namespace FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use BackendBundle\Entity\Product;




class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->render('FrontendBundle::home.html.twig');
    }

    /**
	 * @Route("/qui-sommes-nous")
	 */
	public function aboutAction()
	{
		return $this->render('FrontendBundle::about_us.html.twig');
	}

	/**
	 * @Route("/conditions-generales-de-vente")
	 */
	public function tofAction()
	{
		return $this->render('FrontendBundle::terms_of_sales.html.twig');
	}

	/**
	 * @Route("/livraison")
	 */
	public function shippingAction ()
	{
		return $this->render('FrontendBundle::shipping.html.twig');
	}

	/**
	 * @Route("/confirm-contact")
	 */
	public function confirm_contactAction ()
	{
		return $this->render('FrontendBundle::confirm_contact.html.twig');
	}

	/**
	 * @Route("/electronique")
	 */
	public function electronics_pageAction ()
	{
		$em = $this->getDoctrine()->getManager();
		$products = $em->getRepository('BackendBundle:Product')->findByCategory('1');

		return $this->render('FrontendBundle::electronics_page.html.twig', array(
            'products' => $products,
        ));
	}


	/**
	 * @Route("/kit")
	 */
	public function kits_pageAction ()
	{
		$em = $this->getDoctrine()->getManager();
		$products = $em->getRepository('BackendBundle:Product')->findByCategory('2');
		
		return $this->render('FrontendBundle::kits_page.html.twig', array(
            'products' => $products,
        ));
	}

	/**
	 * @Route("/piece")
	 */
	public function pieces_pageAction ()
	{
		$em = $this->getDoctrine()->getManager();
		$products = $em->getRepository('BackendBundle:Product')->findByCategory('3');
		
		return $this->render('FrontendBundle::pieces_page.html.twig', array(
            'products' => $products,
        ));
	}

	/**
	 * @Route("/consommable")
	 */
	public function consumables_pageAction ()
	{
		$em = $this->getDoctrine()->getManager();
		$products = $em->getRepository('BackendBundle:Product')->findByCategory('4');
		
		return $this->render('FrontendBundle::consumables_page.html.twig', array(
            'products' => $products,
        ));
	}

	/**
	 * @Route("/product/{slug}", name="product_page")
	 * @Method("GET")
	 */
	public function product_pageAction(Product $product)
	{
		return $this->render('FrontendBundle::product_page.html.twig', array(
            'product' => $product,
        ));
	}
}