<?php

namespace BackendBundle\Controller;

use BackendBundle\Entity\GlobalOrder;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Globalorder controller.
 *
 * @Route("globalorder")
 */
class GlobalOrderController extends Controller
{
    /**
     * Lists all globalOrder entities.
     *
     * @Route("/", name="globalorder_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $globalOrders = $em->getRepository('BackendBundle:GlobalOrder')->findAll();

        return $this->render('globalorder/index.html.twig', array(
            'globalOrders' => $globalOrders,
        ));
    }

    /**
     * Creates a new globalOrder entity.
     *
     * @Route("/new", name="globalorder_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $globalOrder = new Globalorder();
        $form = $this->createForm('BackendBundle\Form\GlobalOrderType', $globalOrder);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($globalOrder);
            $em->flush($globalOrder);

            return $this->redirectToRoute('globalorder_show', array('id' => $globalOrder->getId()));
        }

        return $this->render('globalorder/new.html.twig', array(
            'globalOrder' => $globalOrder,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a globalOrder entity.
     *
     * @Route("/{id}", name="globalorder_show")
     * @Method("GET")
     */
    public function showAction(GlobalOrder $globalOrder)
    {
        $deleteForm = $this->createDeleteForm($globalOrder);

        return $this->render('globalorder/show.html.twig', array(
            'globalOrder' => $globalOrder,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing globalOrder entity.
     *
     * @Route("/{id}/edit", name="globalorder_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, GlobalOrder $globalOrder)
    {
        $deleteForm = $this->createDeleteForm($globalOrder);
        $editForm = $this->createForm('BackendBundle\Form\GlobalOrderType', $globalOrder);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('globalorder_edit', array('id' => $globalOrder->getId()));
        }

        return $this->render('globalorder/edit.html.twig', array(
            'globalOrder' => $globalOrder,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a globalOrder entity.
     *
     * @Route("/{id}", name="globalorder_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, GlobalOrder $globalOrder)
    {
        $form = $this->createDeleteForm($globalOrder);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($globalOrder);
            $em->flush($globalOrder);
        }

        return $this->redirectToRoute('globalorder_index');
    }

    /**
     * Creates a form to delete a globalOrder entity.
     *
     * @param GlobalOrder $globalOrder The globalOrder entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(GlobalOrder $globalOrder)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('globalorder_delete', array('id' => $globalOrder->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
