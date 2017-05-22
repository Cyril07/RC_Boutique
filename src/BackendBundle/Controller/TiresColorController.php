<?php

namespace BackendBundle\Controller;

use BackendBundle\Entity\TiresColor;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Tirescolor controller.
 *
 * @Route("tirescolor")
 */
class TiresColorController extends Controller
{
    /**
     * Lists all tiresColor entities.
     *
     * @Route("/", name="tirescolor_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $tiresColors = $em->getRepository('BackendBundle:TiresColor')->findAll();

        return $this->render('tirescolor/index.html.twig', array(
            'tiresColors' => $tiresColors,
        ));
    }

    /**
     * Creates a new tiresColor entity.
     *
     * @Route("/new", name="tirescolor_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $tiresColor = new Tirescolor();
        $form = $this->createForm('BackendBundle\Form\TiresColorType', $tiresColor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tiresColor);
            $em->flush($tiresColor);

            return $this->redirectToRoute('tirescolor_show', array('id' => $tiresColor->getId()));
        }

        return $this->render('tirescolor/new.html.twig', array(
            'tiresColor' => $tiresColor,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a tiresColor entity.
     *
     * @Route("/{id}", name="tirescolor_show")
     * @Method("GET")
     */
    public function showAction(TiresColor $tiresColor)
    {
        $deleteForm = $this->createDeleteForm($tiresColor);

        return $this->render('tirescolor/show.html.twig', array(
            'tiresColor' => $tiresColor,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing tiresColor entity.
     *
     * @Route("/{id}/edit", name="tirescolor_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, TiresColor $tiresColor)
    {
        $deleteForm = $this->createDeleteForm($tiresColor);
        $editForm = $this->createForm('BackendBundle\Form\TiresColorType', $tiresColor);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('tirescolor_edit', array('id' => $tiresColor->getId()));
        }

        return $this->render('tirescolor/edit.html.twig', array(
            'tiresColor' => $tiresColor,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a tiresColor entity.
     *
     * @Route("/{id}", name="tirescolor_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, TiresColor $tiresColor)
    {
        $form = $this->createDeleteForm($tiresColor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($tiresColor);
            $em->flush($tiresColor);
        }

        return $this->redirectToRoute('tirescolor_index');
    }

    /**
     * Creates a form to delete a tiresColor entity.
     *
     * @param TiresColor $tiresColor The tiresColor entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(TiresColor $tiresColor)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tirescolor_delete', array('id' => $tiresColor->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
