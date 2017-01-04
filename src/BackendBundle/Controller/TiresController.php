<?php

namespace BackendBundle\Controller;

use BackendBundle\Entity\Tires;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Tire controller.
 *
 * @Route("tires")
 */
class TiresController extends Controller
{
    /**
     * Lists all tire entities.
     *
     * @Route("/", name="tires_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $tires = $em->getRepository('BackendBundle:Tires')->findAll();

        return $this->render('tires/index.html.twig', array(
            'tires' => $tires,
        ));
    }

    /**
     * Creates a new tire entity.
     *
     * @Route("/new", name="tires_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $tires = new Tires();
        $form = $this->createForm('BackendBundle\Form\TiresType', $tires);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($tires);
            $em->flush($tires);

            return $this->redirectToRoute('tires_show', array('id' => $tires->getId()));
        }

        return $this->render('tires/new.html.twig', array(
            'tires' => $tires,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a tire entity.
     *
     * @Route("/{id}", name="tires_show")
     * @Method("GET")
     */
    public function showAction(Tires $tires)
    {
        $deleteForm = $this->createDeleteForm($tires);

        return $this->render('tires/show.html.twig', array(
            'tires' => $tires,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing tire entity.
     *
     * @Route("/{id}/edit", name="tires_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Tires $tires)
    {
        $deleteForm = $this->createDeleteForm($tire);
        $editForm = $this->createForm('BackendBundle\Form\TiresType', $tires);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('tires_edit', array('id' => $tires->getId()));
        }

        return $this->render('tires/edit.html.twig', array(
            'tires' => $tires,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a tire entity.
     *
     * @Route("/{id}", name="tires_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Tires $tires)
    {
        $form = $this->createDeleteForm($tires);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($tires);
            $em->flush($tires);
        }

        return $this->redirectToRoute('tires_index');
    }

    /**
     * Creates a form to delete a tire entity.
     *
     * @param Tires $tire The tire entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Tires $tires)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tires_delete', array('id' => $tires->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
