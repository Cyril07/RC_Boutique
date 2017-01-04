<?php

namespace BackendBundle\Controller;

use BackendBundle\Entity\Scale;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Scale controller.
 *
 * @Route("scale")
 */
class ScaleController extends Controller
{
    /**
     * Lists all scale entities.
     *
     * @Route("/", name="scale_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $scales = $em->getRepository('BackendBundle:Scale')->findAll();

        return $this->render('scale/index.html.twig', array(
            'scales' => $scales,
        ));
    }

    /**
     * Creates a new scale entity.
     *
     * @Route("/new", name="scale_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $scale = new Scale();
        $form = $this->createForm('BackendBundle\Form\ScaleType', $scale);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($scale);
            $em->flush($scale);

            return $this->redirectToRoute('scale_show', array('id' => $scale->getId()));
        }

        return $this->render('scale/new.html.twig', array(
            'scale' => $scale,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a scale entity.
     *
     * @Route("/{id}", name="scale_show")
     * @Method("GET")
     */
    public function showAction(Scale $scale)
    {
        $deleteForm = $this->createDeleteForm($scale);

        return $this->render('scale/show.html.twig', array(
            'scale' => $scale,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing scale entity.
     *
     * @Route("/{id}/edit", name="scale_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Scale $scale)
    {
        $deleteForm = $this->createDeleteForm($scale);
        $editForm = $this->createForm('BackendBundle\Form\ScaleType', $scale);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('scale_edit', array('id' => $scale->getId()));
        }

        return $this->render('scale/edit.html.twig', array(
            'scale' => $scale,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a scale entity.
     *
     * @Route("/{id}", name="scale_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Scale $scale)
    {
        $form = $this->createDeleteForm($scale);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($scale);
            $em->flush($scale);
        }

        return $this->redirectToRoute('scale_index');
    }

    /**
     * Creates a form to delete a scale entity.
     *
     * @param Scale $scale The scale entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Scale $scale)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('scale_delete', array('id' => $scale->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
