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
     * @Route("/", name="home")
     */
    public function indexAction()
    {
        return $this->render('FrontendBundle::home.html.twig');
    }

    /**
	 * @Route("/qui-sommes-nous", name="about_us")
	 */
	public function aboutAction()
	{
		return $this->render('FrontendBundle::about_us.html.twig');
	}

	/**
	 * @Route("/conditions-generales-de-vente", name="terms_of_sales")
	 */
	public function tofAction()
	{
		return $this->render('FrontendBundle::terms_of_sales.html.twig');
	}

	/**
	 * @Route("/livraison", name="shipping")
	 */
	public function shippingAction ()
	{
		return $this->render('FrontendBundle::shipping.html.twig');
	}

	/**
	 * @Route("/confirm-contact", name="confirm_contact")
	 */
	public function confirm_contactAction ()
	{
		return $this->render('FrontendBundle::confirm_contact.html.twig');
	}

	/**
	 * @Route("/electronique", name="electronics_page")
	 */
	public function electronics_pageAction (Request $request)
	{
		$em = $this->getDoctrine()->getManager();

        $query = $em->createQuery(
        	'SELECT p
        	FROM BackendBundle:Product p
        	WHERE p.category = :category'
        )->setParameter('category', 1);

        $paginator  = $this->get('knp_paginator');

        $products = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            $request->query->getInt('limit', 8)/*limit per page*/
        );
		
		return $this->render('FrontendBundle::electronics_page.html.twig', array(
            'products' => $products,
        ));
	}

	/**
	 * @Route("/kit", name="kits_page")
	 */
	public function kits_pageAction (Request $request)
	{
		$em = $this->getDoctrine()->getManager();

        $query = $em->createQuery(
        	'SELECT p
        	FROM BackendBundle:Product p
        	WHERE p.category = :category'
        )->setParameter('category',2);

        $paginator  = $this->get('knp_paginator');

        $products = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            $request->query->getInt('limit', 8)/*limit per page*/
        );
		
		return $this->render('FrontendBundle::kits_page.html.twig', array(
            'products' => $products,
        ));
	}

	/**
	 * @Route("/part", name="pieces_page")
	 */
	public function pieces_pageAction (Request $request)
	{
		$em = $this->getDoctrine()->getManager();

        $query = $em->createQuery(
        	'SELECT p
        	FROM BackendBundle:Product p
        	WHERE p.category = :category'
        )->setParameter('category', 3);

        $paginator  = $this->get('knp_paginator');

        $products = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            $request->query->getInt('limit', 8)/*limit per page*/
        );
		
		return $this->render('FrontendBundle::pieces_page.html.twig', array(
            'products' => $products,
        ));
	}

	/**
	 * @Route("/consommable", name="consumables_pages")
	 */
	public function consumables_pageAction (Request $request)
	{
		$em = $this->getDoctrine()->getManager();

        $query = $em->createQuery(
        	'SELECT p
        	FROM BackendBundle:Product p
        	WHERE p.category = :category'
        )->setParameter('category', 4);

        $paginator  = $this->get('knp_paginator');

        $products = $paginator->paginate(
            $query, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            $request->query->getInt('limit', 8)/*limit per page*/
        );
		
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

	/**
	 * @Route("/recherche", name="search_page")
	 * @Method({"GET", "POST"})
	 */
	public function search_pageAction(Request $request)
	{
		$em = $this->getDoctrine()->getManager();

		$research = $request->query->get('research_product');

		//var_dump($research);die;
		
		$products = $em->getRepository('BackendBundle:Product')->getResultResearch($research);

		return $this->render('FrontendBundle::search_page.html.twig', array(
            'products' => $products,
            'research' => $research,
        ));
	}
}