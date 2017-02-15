<?php

namespace FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

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
		return $this->render('FrontendBundle:Layout:about_us.html.twig');
	}

	/**
	 * @Route("/conditions-generales-de-vente")
	 */
	public function tofAction()
	{
		return $this->render('FrontendBundle:Layout:terms_of_sales.html.twig');
	}

	/**
	 * @Route("/contact")
	 */
	public function contactAction ()
	{
		return $this->render('FrontendBundle:Layout:contact.html.twig');
	}

	/**
	 * @Route("/livraison")
	 */
	public function shippingAction ()
	{
		return $this->render('FrontendBundle:Layout:shipping.html.twig');
	}
}
