<?php

namespace BackendBundle\Controller;

use BackendBundle\Entity\OrderDetail;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Orderdetail controller.
 *
 * @Route("orderdetail")
 */
class OrderDetailController extends Controller
{
    /**
     * Lists all orderDetail entities.
     *
     * @Route("/", name="orderdetail_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $orderDetails = $em->getRepository('BackendBundle:OrderDetail')->findAll();

        return $this->render('orderdetail/index.html.twig', array(
            'orderDetails' => $orderDetails,
        ));
    }

    /**
     * Creates a new orderDetail entity.
     *
     * @Route("/new", name="orderdetail_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $orderDetail = new Orderdetail();
        $form = $this->createForm('BackendBundle\Form\OrderDetailType', $orderDetail);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($orderDetail);
            $em->flush($orderDetail);

            return $this->redirectToRoute('orderdetail_show', array('id' => $orderDetail->getId()));
        }

        return $this->render('orderdetail/new.html.twig', array(
            'orderDetail' => $orderDetail,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a orderDetail entity.
     *
     * @Route("/{id}", name="orderdetail_show")
     * @Method("GET")
     */
    public function showAction(OrderDetail $orderDetail)
    {
        $deleteForm = $this->createDeleteForm($orderDetail);

        return $this->render('orderdetail/show.html.twig', array(
            'orderDetail' => $orderDetail,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing orderDetail entity.
     *
     * @Route("/{id}/edit", name="orderdetail_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, OrderDetail $orderDetail)
    {
        $deleteForm = $this->createDeleteForm($orderDetail);
        $editForm = $this->createForm('BackendBundle\Form\OrderDetailType', $orderDetail);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('orderdetail_edit', array('id' => $orderDetail->getId()));
        }

        return $this->render('orderdetail/edit.html.twig', array(
            'orderDetail' => $orderDetail,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a orderDetail entity.
     *
     * @Route("/{id}", name="orderdetail_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, OrderDetail $orderDetail)
    {
        $form = $this->createDeleteForm($orderDetail);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($orderDetail);
            $em->flush($orderDetail);
        }

        return $this->redirectToRoute('orderdetail_index');
    }

    /**
     * Creates a form to delete a orderDetail entity.
     *
     * @param OrderDetail $orderDetail The orderDetail entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(OrderDetail $orderDetail)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('orderdetail_delete', array('id' => $orderDetail->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
