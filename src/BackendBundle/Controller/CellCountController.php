<?php

namespace BackendBundle\Controller;

use BackendBundle\Entity\CellCount;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Cellcount controller.
 *
 * @Route("cellcount")
 */
class CellCountController extends Controller
{
    /**
     * Lists all cellCount entities.
     *
     * @Route("/", name="cellcount_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $cellCounts = $em->getRepository('BackendBundle:CellCount')->findAll();

        return $this->render('cellcount/index.html.twig', array(
            'cellCounts' => $cellCounts,
        ));
    }

    /**
     * Creates a new cellCount entity.
     *
     * @Route("/new", name="cellcount_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $cellCount = new Cellcount();
        $form = $this->createForm('BackendBundle\Form\CellCountType', $cellCount);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($cellCount);
            $em->flush($cellCount);

            return $this->redirectToRoute('cellcount_show', array('id' => $cellCount->getId()));
        }

        return $this->render('cellcount/new.html.twig', array(
            'cellCount' => $cellCount,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a cellCount entity.
     *
     * @Route("/{id}", name="cellcount_show")
     * @Method("GET")
     */
    public function showAction(CellCount $cellCount)
    {
        $deleteForm = $this->createDeleteForm($cellCount);

        return $this->render('cellcount/show.html.twig', array(
            'cellCount' => $cellCount,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing cellCount entity.
     *
     * @Route("/{id}/edit", name="cellcount_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, CellCount $cellCount)
    {
        $deleteForm = $this->createDeleteForm($cellCount);
        $editForm = $this->createForm('BackendBundle\Form\CellCountType', $cellCount);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('cellcount_edit', array('id' => $cellCount->getId()));
        }

        return $this->render('cellcount/edit.html.twig', array(
            'cellCount' => $cellCount,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a cellCount entity.
     *
     * @Route("/{id}", name="cellcount_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, CellCount $cellCount)
    {
        $form = $this->createDeleteForm($cellCount);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($cellCount);
            $em->flush($cellCount);
        }

        return $this->redirectToRoute('cellcount_index');
    }

    /**
     * Creates a form to delete a cellCount entity.
     *
     * @param CellCount $cellCount The cellCount entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(CellCount $cellCount)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('cellcount_delete', array('id' => $cellCount->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
