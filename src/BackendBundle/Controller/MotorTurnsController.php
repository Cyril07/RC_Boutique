<?php

namespace BackendBundle\Controller;

use BackendBundle\Entity\MotorTurns;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Motorturn controller.
 *
 * @Route("motorturns")
 */
class MotorTurnsController extends Controller
{
    /**
     * Lists all motorTurn entities.
     *
     * @Route("/", name="motorturns_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $motorTurns = $em->getRepository('BackendBundle:MotorTurns')->findAll();

        return $this->render('motorturns/index.html.twig', array(
            'motorTurns' => $motorTurns,
        ));
    }

    /**
     * Creates a new motorTurn entity.
     *
     * @Route("/new", name="motorturns_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $motorTurns = new Motorturns();
        $form = $this->createForm('BackendBundle\Form\MotorTurnsType', $motorTurns);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($motorTurns);
            $em->flush($motorTurns);

            return $this->redirectToRoute('motorturns_show', array('id' => $motorTurns->getId()));
        }

        return $this->render('motorturns/new.html.twig', array(
            'motorTurns' => $motorTurns,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a motorTurn entity.
     *
     * @Route("/{id}", name="motorturns_show")
     * @Method("GET")
     */
    public function showAction(MotorTurns $motorTurns)
    {
        $deleteForm = $this->createDeleteForm($motorTurns);

        return $this->render('motorturns/show.html.twig', array(
            'motorTurns' => $motorTurns,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing motorTurn entity.
     *
     * @Route("/{id}/edit", name="motorturns_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, MotorTurns $motorTurns)
    {
        $deleteForm = $this->createDeleteForm($motorTurns);
        $editForm = $this->createForm('BackendBundle\Form\MotorTurnsType', $motorTurns);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('motorturns_edit', array('id' => $motorTurns->getId()));
        }

        return $this->render('motorturns/edit.html.twig', array(
            'motorTurns' => $motorTurns,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a motorTurn entity.
     *
     * @Route("/{id}", name="motorturns_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, MotorTurns $motorTurns)
    {
        $form = $this->createDeleteForm($motorTurns);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($motorTurns);
            $em->flush($motorTurns);
        }

        return $this->redirectToRoute('motorturns_index');
    }

    /**
     * Creates a form to delete a motorTurn entity.
     *
     * @param MotorTurns $motorTurn The motorTurn entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(MotorTurns $motorTurns)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('motorturns_delete', array('id' => $motorTurns->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
