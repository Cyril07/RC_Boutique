<?php

namespace BackendBundle\Controller;

use BackendBundle\Entity\Power;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Power controller.
 *
 * @Route("power")
 */
class PowerController extends Controller
{
    /**
     * Lists all power entities.
     *
     * @Route("/", name="power_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $powers = $em->getRepository('BackendBundle:Power')->findAll();

        return $this->render('power/index.html.twig', array(
            'powers' => $powers,
        ));
    }

    /**
     * Creates a new power entity.
     *
     * @Route("/new", name="power_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $power = new Power();
        $form = $this->createForm('BackendBundle\Form\PowerType', $power);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($power);
            $em->flush($power);

            return $this->redirectToRoute('power_show', array('id' => $power->getId()));
        }

        return $this->render('power/new.html.twig', array(
            'power' => $power,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a power entity.
     *
     * @Route("/{id}", name="power_show")
     * @Method("GET")
     */
    public function showAction(Power $power)
    {
        $deleteForm = $this->createDeleteForm($power);

        return $this->render('power/show.html.twig', array(
            'power' => $power,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing power entity.
     *
     * @Route("/{id}/edit", name="power_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Power $power)
    {
        $deleteForm = $this->createDeleteForm($power);
        $editForm = $this->createForm('BackendBundle\Form\PowerType', $power);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('power_edit', array('id' => $power->getId()));
        }

        return $this->render('power/edit.html.twig', array(
            'power' => $power,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a power entity.
     *
     * @Route("/{id}", name="power_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Power $power)
    {
        $form = $this->createDeleteForm($power);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($power);
            $em->flush($power);
        }

        return $this->redirectToRoute('power_index');
    }

    /**
     * Creates a form to delete a power entity.
     *
     * @param Power $power The power entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Power $power)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('power_delete', array('id' => $power->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
