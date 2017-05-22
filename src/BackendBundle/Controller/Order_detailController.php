<?php

namespace BackendBundle\Controller;

use BackendBundle\Entity\Order_detail;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use BackendBundle\Entity\Product;

/**
 * Order_detail controller.
 *
 * @Route("Order_detail")
 */
class Order_detailController extends Controller
{
    /**
     * Lists all order_detail entities.
     *
     * @Route("/", name="order_detail_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $order_details = $em->getRepository('BackendBundle:Order_detail')->findAll();

        return $this->render('order_detail/index.html.twig', array(
            'order_details' => $order_details,
        ));
    }

    /**
     * Creates a new order entity.
     *
     * @Route("/new", name="order_detail_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $order_detail = new Order_detail();
        $form = $this->createForm('BackendBundle\Form\Order_detailType', $order_detail);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($order_detail);
            $em->flush($order_detail);

            return $this->redirectToRoute('order_detail_show', array('id' => $order_detail->getId()));
        }

        return $this->render('order_detail/new.html.twig', array(
            'order_detail' => $order_detail,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a order_detail entity.
     *
     * @Route("/{id}", name="order_detail_show")
     * @Method("GET")
     */
    public function showAction(Order_detail $order_detail)
    {
        $deleteForm = $this->createDeleteForm($order_detail);

        return $this->render('order_detail/show.html.twig', array(
            'order_detail' => $order_detail,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing order_detail entity.
     *
     * @Route("/{id}/edit", name="order_detail_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Order_detail $order_detail)
    {
        $deleteForm = $this->createDeleteForm($order_detail);
        $editForm = $this->createForm('BackendBundle\Form\OrderType', $order);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('order_detail_edit', array('id' => $order_detail->getId()));
        }

        return $this->render('order_detail/edit.html.twig', array(
            'order_detail' => $order,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a order_detail entity.
     *
     * @Route("/{id}", name="order_detail_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Order_detail $order_detail)
    {
        $form = $this->createDeleteForm($order_detail);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($order_detail);
            $em->flush($order_detail);
        }

        return $this->redirectToRoute('order_detail_index');
    }

    /**
     * Creates a form to delete a order_detail entity.
     *
     * @param Order_detail $order_detail The order_detail entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Order_detail $order_detail)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('order_detail_delete', array('id' => $order_detail->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
