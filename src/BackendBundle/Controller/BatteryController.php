<?php

namespace BackendBundle\Controller;

use BackendBundle\Entity\Battery;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Battery controller.
 *
 * @Route("battery")
 */
class BatteryController extends Controller
{
    /**
     * Lists all battery entities.
     *
     * @Route("/", name="battery_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $batteries = $em->getRepository('BackendBundle:Battery')->findAll();

        return $this->render('battery/index.html.twig', array(
            'batteries' => $batteries,
        ));
    }

    /**
     * Creates a new battery entity.
     *
     * @Route("/new", name="battery_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $battery = new Battery();
        $form = $this->createForm('BackendBundle\Form\BatteryType', $battery);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($battery);
            $em->flush($battery);

            return $this->redirectToRoute('battery_show', array('id' => $battery->getId()));
        }

        return $this->render('battery/new.html.twig', array(
            'battery' => $battery,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a battery entity.
     *
     * @Route("/{id}", name="battery_show")
     * @Method("GET")
     */
    public function showAction(Battery $battery)
    {
        $deleteForm = $this->createDeleteForm($battery);

        return $this->render('battery/show.html.twig', array(
            'battery' => $battery,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing battery entity.
     *
     * @Route("/{id}/edit", name="battery_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Battery $battery)
    {
        $deleteForm = $this->createDeleteForm($battery);
        $editForm = $this->createForm('BackendBundle\Form\BatteryType', $battery);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('battery_edit', array('id' => $battery->getId()));
        }

        return $this->render('battery/edit.html.twig', array(
            'battery' => $battery,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a battery entity.
     *
     * @Route("/{id}", name="battery_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Battery $battery)
    {
        $form = $this->createDeleteForm($battery);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($battery);
            $em->flush($battery);
        }

        return $this->redirectToRoute('battery_index');
    }

    /**
     * Creates a form to delete a battery entity.
     *
     * @param Battery $battery The battery entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Battery $battery)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('battery_delete', array('id' => $battery->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
