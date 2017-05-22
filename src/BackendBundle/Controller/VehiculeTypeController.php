<?php

namespace BackendBundle\Controller;

use BackendBundle\Entity\VehiculeType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Vehiculetype controller.
 *
 * @Route("vehiculetype")
 */
class VehiculeTypeController extends Controller
{
    /**
     * Lists all vehiculeType entities.
     *
     * @Route("/", name="vehiculetype_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $vehiculeTypes = $em->getRepository('BackendBundle:VehiculeType')->findAll();

        return $this->render('vehiculetype/index.html.twig', array(
            'vehiculeTypes' => $vehiculeTypes,
        ));
    }

    /**
     * Creates a new vehiculeType entity.
     *
     * @Route("/new", name="vehiculetype_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $vehiculeType = new Vehiculetype();
        $form = $this->createForm('BackendBundle\Form\VehiculeTypeType', $vehiculeType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($vehiculeType);
            $em->flush($vehiculeType);

            return $this->redirectToRoute('vehiculetype_show', array('id' => $vehiculeType->getId()));
        }

        return $this->render('vehiculetype/new.html.twig', array(
            'vehiculeType' => $vehiculeType,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a vehiculeType entity.
     *
     * @Route("/{id}", name="vehiculetype_show")
     * @Method("GET")
     */
    public function showAction(VehiculeType $vehiculeType)
    {
        $deleteForm = $this->createDeleteForm($vehiculeType);

        return $this->render('vehiculetype/show.html.twig', array(
            'vehiculeType' => $vehiculeType,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing vehiculeType entity.
     *
     * @Route("/{id}/edit", name="vehiculetype_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, VehiculeType $vehiculeType)
    {
        $deleteForm = $this->createDeleteForm($vehiculeType);
        $editForm = $this->createForm('BackendBundle\Form\VehiculeTypeType', $vehiculeType);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('vehiculetype_edit', array('id' => $vehiculeType->getId()));
        }

        return $this->render('vehiculetype/edit.html.twig', array(
            'vehiculeType' => $vehiculeType,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a vehiculeType entity.
     *
     * @Route("/{id}", name="vehiculetype_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, VehiculeType $vehiculeType)
    {
        $form = $this->createDeleteForm($vehiculeType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($vehiculeType);
            $em->flush($vehiculeType);
        }

        return $this->redirectToRoute('vehiculetype_index');
    }

    /**
     * Creates a form to delete a vehiculeType entity.
     *
     * @param VehiculeType $vehiculeType The vehiculeType entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(VehiculeType $vehiculeType)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('vehiculetype_delete', array('id' => $vehiculeType->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
