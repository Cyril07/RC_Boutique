<?php

namespace FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FrontendBundle\Entity\Contact;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;


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
	public function confirm_contact ()
	{
		return $this->render('FrontendBundle::confirm_contact.html.twig');
	}
}
