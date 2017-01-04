<?php

namespace BackendBundle\Controller;

use BackendBundle\Entity\Wt;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Wt controller.
 *
 * @Route("wt")
 */
class WtController extends Controller
{
    /**
     * Lists all wt entities.
     *
     * @Route("/", name="wt_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $wts = $em->getRepository('BackendBundle:Wt')->findAll();

        return $this->render('wt/index.html.twig', array(
            'wts' => $wts,
        ));
    }

    /**
     * Creates a new wt entity.
     *
     * @Route("/new", name="wt_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $wt = new Wt();
        $form = $this->createForm('BackendBundle\Form\WtType', $wt);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($wt);
            $em->flush($wt);

            return $this->redirectToRoute('wt_show', array('id' => $wt->getId()));
        }

        return $this->render('wt/new.html.twig', array(
            'wt' => $wt,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a wt entity.
     *
     * @Route("/{id}", name="wt_show")
     * @Method("GET")
     */
    public function showAction(Wt $wt)
    {
        $deleteForm = $this->createDeleteForm($wt);

        return $this->render('wt/show.html.twig', array(
            'wt' => $wt,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing wt entity.
     *
     * @Route("/{id}/edit", name="wt_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Wt $wt)
    {
        $deleteForm = $this->createDeleteForm($wt);
        $editForm = $this->createForm('BackendBundle\Form\WtType', $wt);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('wt_edit', array('id' => $wt->getId()));
        }

        return $this->render('wt/edit.html.twig', array(
            'wt' => $wt,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a wt entity.
     *
     * @Route("/{id}", name="wt_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Wt $wt)
    {
        $form = $this->createDeleteForm($wt);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($wt);
            $em->flush($wt);
        }

        return $this->redirectToRoute('wt_index');
    }

    /**
     * Creates a form to delete a wt entity.
     *
     * @param Wt $wt The wt entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Wt $wt)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('wt_delete', array('id' => $wt->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
