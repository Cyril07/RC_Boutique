<?php

namespace BackendBundle\Controller;

use BackendBundle\Entity\BatteryType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Batterytype controller.
 *
 * @Route("batterytype")
 */
class BatteryTypeController extends Controller
{
    /**
     * Lists all batteryType entities.
     *
     * @Route("/", name="batterytype_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $batteryTypes = $em->getRepository('BackendBundle:BatteryType')->findAll();

        return $this->render('batterytype/index.html.twig', array(
            'batteryTypes' => $batteryTypes,
        ));
    }

    /**
     * Creates a new batteryType entity.
     *
     * @Route("/new", name="batterytype_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $batteryType = new Batterytype();
        $form = $this->createForm('BackendBundle\Form\BatteryTypeType', $batteryType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($batteryType);
            $em->flush($batteryType);

            return $this->redirectToRoute('batterytype_show', array('id' => $batteryType->getId()));
        }

        return $this->render('batterytype/new.html.twig', array(
            'batteryType' => $batteryType,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a batteryType entity.
     *
     * @Route("/{id}", name="batterytype_show")
     * @Method("GET")
     */
    public function showAction(BatteryType $batteryType)
    {
        $deleteForm = $this->createDeleteForm($batteryType);

        return $this->render('batterytype/show.html.twig', array(
            'batteryType' => $batteryType,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing batteryType entity.
     *
     * @Route("/{id}/edit", name="batterytype_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, BatteryType $batteryType)
    {
        $deleteForm = $this->createDeleteForm($batteryType);
        $editForm = $this->createForm('BackendBundle\Form\BatteryTypeType', $batteryType);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('batterytype_edit', array('id' => $batteryType->getId()));
        }

        return $this->render('batterytype/edit.html.twig', array(
            'batteryType' => $batteryType,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a batteryType entity.
     *
     * @Route("/{id}", name="batterytype_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, BatteryType $batteryType)
    {
        $form = $this->createDeleteForm($batteryType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($batteryType);
            $em->flush($batteryType);
        }

        return $this->redirectToRoute('batterytype_index');
    }

    /**
     * Creates a form to delete a batteryType entity.
     *
     * @param BatteryType $batteryType The batteryType entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(BatteryType $batteryType)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('batterytype_delete', array('id' => $batteryType->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
