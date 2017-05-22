<?php

namespace BackendBundle\Controller;

use BackendBundle\Entity\Esc;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Esc controller.
 *
 * @Route("esc")
 */
class EscController extends Controller
{
    /**
     * Lists all esc entities.
     *
     * @Route("/", name="esc_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $escs = $em->getRepository('BackendBundle:Esc')->findAll();

        return $this->render('esc/index.html.twig', array(
            'escs' => $escs,
        ));
    }

    /**
     * Creates a new esc entity.
     *
     * @Route("/new", name="esc_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $esc = new Esc();
        $form = $this->createForm('BackendBundle\Form\EscType', $esc);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($esc);
            $em->flush($esc);

            return $this->redirectToRoute('esc_show', array('id' => $esc->getId()));
        }

        return $this->render('esc/new.html.twig', array(
            'esc' => $esc,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a esc entity.
     *
     * @Route("/{id}", name="esc_show")
     * @Method("GET")
     */
    public function showAction(Esc $esc)
    {
        $deleteForm = $this->createDeleteForm($esc);

        return $this->render('esc/show.html.twig', array(
            'esc' => $esc,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing esc entity.
     *
     * @Route("/{id}/edit", name="esc_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Esc $esc)
    {
        $deleteForm = $this->createDeleteForm($esc);
        $editForm = $this->createForm('BackendBundle\Form\EscType', $esc);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('esc_edit', array('id' => $esc->getId()));
        }

        return $this->render('esc/edit.html.twig', array(
            'esc' => $esc,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a esc entity.
     *
     * @Route("/{id}", name="esc_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Esc $esc)
    {
        $form = $this->createDeleteForm($esc);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($esc);
            $em->flush($esc);
        }

        return $this->redirectToRoute('esc_index');
    }

    /**
     * Creates a form to delete a esc entity.
     *
     * @param Esc $esc The esc entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Esc $esc)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('esc_delete', array('id' => $esc->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
