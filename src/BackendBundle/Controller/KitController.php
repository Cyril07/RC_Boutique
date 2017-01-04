<?php

namespace BackendBundle\Controller;

use BackendBundle\Entity\Kit;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Kit controller.
 *
 * @Route("kit")
 */
class KitController extends Controller
{
    /**
     * Lists all kit entities.
     *
     * @Route("/", name="kit_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $kits = $em->getRepository('BackendBundle:Kit')->findAll();

        return $this->render('kit/index.html.twig', array(
            'kits' => $kits,
        ));
    }

    /**
     * Creates a new kit entity.
     *
     * @Route("/new", name="kit_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $kit = new Kit();
        $form = $this->createForm('BackendBundle\Form\KitType', $kit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($kit);
            $em->flush($kit);

            return $this->redirectToRoute('kit_show', array('id' => $kit->getId()));
        }

        return $this->render('kit/new.html.twig', array(
            'kit' => $kit,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a kit entity.
     *
     * @Route("/{id}", name="kit_show")
     * @Method("GET")
     */
    public function showAction(Kit $kit)
    {
        $deleteForm = $this->createDeleteForm($kit);

        return $this->render('kit/show.html.twig', array(
            'kit' => $kit,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing kit entity.
     *
     * @Route("/{id}/edit", name="kit_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Kit $kit)
    {
        $deleteForm = $this->createDeleteForm($kit);
        $editForm = $this->createForm('BackendBundle\Form\KitType', $kit);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('kit_edit', array('id' => $kit->getId()));
        }

        return $this->render('kit/edit.html.twig', array(
            'kit' => $kit,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a kit entity.
     *
     * @Route("/{id}", name="kit_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Kit $kit)
    {
        $form = $this->createDeleteForm($kit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($kit);
            $em->flush($kit);
        }

        return $this->redirectToRoute('kit_index');
    }

    /**
     * Creates a form to delete a kit entity.
     *
     * @param Kit $kit The kit entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Kit $kit)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('kit_delete', array('id' => $kit->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
