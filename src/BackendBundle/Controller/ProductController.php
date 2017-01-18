<?php

namespace BackendBundle\Controller;

use BackendBundle\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Product controller.
 *
 * @Route("product")
 */
class ProductController extends Controller
{
    /**
     * Lists all product entities.
     *
     * @Route("/", name="product_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $products = $em->getRepository('BackendBundle:Product')->findAll();

        return $this->render('product/index.html.twig', array(
            'products' => $products,
        ));
    }

    /**
     * Creates a new product entity.
     *
     * @Route("/new", name="product_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $product = new Product();
        $form = $this->createForm('BackendBundle\Form\ProductType', $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($product);
            $em->flush($product);

            return $this->redirectToRoute('product_show', array('id' => $product->getId()));
        }

        return $this->render('product/new.html.twig', array(
            'product' => $product,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a product entity.
     *
     * @Route("/{id}", name="product_show")
     * @Method("GET")
     */
    public function showAction(Product $product)
    {
        $deleteForm = $this->createDeleteForm($product);

        return $this->render('product/show.html.twig', array(
            'product' => $product,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing product entity.
     *
     * @Route("/{id}/edit", name="product_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Product $product)
    {
        $deleteForm = $this->createDeleteForm($product);
        $em=$this->getDoctrine()->getManager();
        
        $motors = $em->getRepository('BackendBundle:Motor')->findAll();
        $escs = $em->getRepository('BackendBundle:Esc')->findAll();
        $batteries = $em->getRepository('BackendBundle:Battery')->findAll();
        $bodies = $em->getRepository('BackendBundle:Body')->findAll();
        $kits = $em->getRepository('BackendBundle:Kit')->findAll();
        $oils = $em->getRepository('BackendBundle:Oil')->findAll();
        $tires = $em->getRepository('BackendBundle:Tires')->findAll();
        $editForm = $this->createForm('BackendBundle\Form\ProductType', $product);

        $editForm->handleRequest($request);

        $motorForm = $this->createForm('BackendBundle\Form\MotorType',$product->getMotor());
        $escForm = $this->createForm('BackendBundle\Form\EscType',$product->getEsc());
        $batteryForm = $this->createForm('BackendBundle\Form\BatteryType',$product->getBattery());
        $bodyForm = $this->createForm('BackendBundle\Form\BodyType',$product->getBody());
        $kitForm = $this->createForm('BackendBundle\Form\KitType',$product->getKit());
        $oilForm = $this->createForm('BackendBundle\Form\OilType',$product->getOil());
        $tiresForm = $this->createForm('BackendBundle\Form\TiresType',$product->getTires());


        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $em->flush();

            return $this->redirectToRoute('product_edit', array('id' => $product->getId()));
        }

        return $this->render('product/edit.html.twig', array(
            'product' => $product,
            'motors'=> $motors,
            'escs' => $escs,
            'batteries' => $batteries,
            'bodies' => $bodies,
            'kits' => $kits,
            'oils' => $oils,
            'tires' => $tires,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'motor_form' => $motorForm->createView(),

        ));
    }

    /**
     * Deletes a product entity.
     *
     * @Route("/{id}", name="product_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Product $product)
    {
        $form = $this->createDeleteForm($product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($product);
            $em->flush($product);
        }

        return $this->redirectToRoute('product_index');
    }

    /**
     * Creates a form to delete a product entity.
     *
     * @param Product $product The product entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Product $product)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('product_delete', array('id' => $product->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}