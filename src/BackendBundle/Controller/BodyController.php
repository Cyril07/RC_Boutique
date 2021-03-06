<?php

namespace BackendBundle\Controller;

use BackendBundle\Entity\Body;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Body controller.
 *
 * @Route("body")
 */
class BodyController extends Controller
{
    /**
     * Lists all body entities.
     *
     * @Route("/", name="body_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $bodies = $em->getRepository('BackendBundle:Body')->findAll();

        return $this->render('body/index.html.twig', array(
            'bodies' => $bodies,
        ));
    }

    /**
     * Creates a new body entity.
     *
     * @Route("/new", name="body_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $body = new Body();
        $form = $this->createForm('BackendBundle\Form\BodyType', $body);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($body);
            $em->flush($body);

            return $this->redirectToRoute('body_show', array('id' => $body->getId()));
        }

        return $this->render('body/new.html.twig', array(
            'body' => $body,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a body entity.
     *
     * @Route("/{id}", name="body_show")
     * @Method("GET")
     */
    public function showAction(Body $body)
    {
        $deleteForm = $this->createDeleteForm($body);

        return $this->render('body/show.html.twig', array(
            'body' => $body,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing body entity.
     *
     * @Route("/{id}/edit", name="body_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Body $body)
    {
        $deleteForm = $this->createDeleteForm($body);
        $editForm = $this->createForm('BackendBundle\Form\BodyType', $body);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('body_edit', array('id' => $body->getId()));
        }

        return $this->render('body/edit.html.twig', array(
            'body' => $body,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a body entity.
     *
     * @Route("/{id}", name="body_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Body $body)
    {
        $form = $this->createDeleteForm($body);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($body);
            $em->flush($body);
        }

        return $this->redirectToRoute('body_index');
    }

    /**
     * Creates a form to delete a body entity.
     *
     * @param Body $body The body entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Body $body)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('body_delete', array('id' => $body->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
