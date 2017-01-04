<?php

namespace BackendBundle\Controller;

use BackendBundle\Entity\Oil;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Oil controller.
 *
 * @Route("oil")
 */
class OilController extends Controller
{
    /**
     * Lists all oil entities.
     *
     * @Route("/", name="oil_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $oils = $em->getRepository('BackendBundle:Oil')->findAll();

        return $this->render('oil/index.html.twig', array(
            'oils' => $oils,
        ));
    }

    /**
     * Creates a new oil entity.
     *
     * @Route("/new", name="oil_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $oil = new Oil();
        $form = $this->createForm('BackendBundle\Form\OilType', $oil);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($oil);
            $em->flush($oil);

            return $this->redirectToRoute('oil_show', array('id' => $oil->getId()));
        }

        return $this->render('oil/new.html.twig', array(
            'oil' => $oil,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a oil entity.
     *
     * @Route("/{id}", name="oil_show")
     * @Method("GET")
     */
    public function showAction(Oil $oil)
    {
        $deleteForm = $this->createDeleteForm($oil);

        return $this->render('oil/show.html.twig', array(
            'oil' => $oil,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing oil entity.
     *
     * @Route("/{id}/edit", name="oil_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Oil $oil)
    {
        $deleteForm = $this->createDeleteForm($oil);
        $editForm = $this->createForm('BackendBundle\Form\OilType', $oil);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('oil_edit', array('id' => $oil->getId()));
        }

        return $this->render('oil/edit.html.twig', array(
            'oil' => $oil,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a oil entity.
     *
     * @Route("/{id}", name="oil_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Oil $oil)
    {
        $form = $this->createDeleteForm($oil);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($oil);
            $em->flush($oil);
        }

        return $this->redirectToRoute('oil_index');
    }

    /**
     * Creates a form to delete a oil entity.
     *
     * @param Oil $oil The oil entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Oil $oil)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('oil_delete', array('id' => $oil->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
