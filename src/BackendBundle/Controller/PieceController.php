<?php

namespace BackendBundle\Controller;

use BackendBundle\Entity\Piece;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Piece controller.
 *
 * @Route("piece")
 */
class PieceController extends Controller
{
    /**
     * Lists all piece entities.
     *
     * @Route("/", name="piece_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $pieces = $em->getRepository('BackendBundle:Piece')->findAll();

        return $this->render('piece/index.html.twig', array(
            'pieces' => $pieces,
        ));
    }

    /**
     * Creates a new piece entity.
     *
     * @Route("/new", name="piece_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $piece = new Piece();
        $form = $this->createForm('BackendBundle\Form\PieceType', $piece);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($piece);
            $em->flush($piece);

            return $this->redirectToRoute('piece_show', array('id' => $piece->getId()));
        }

        return $this->render('piece/new.html.twig', array(
            'piece' => $piece,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a piece entity.
     *
     * @Route("/{id}", name="piece_show")
     * @Method("GET")
     */
    public function showAction(Piece $piece)
    {
        $deleteForm = $this->createDeleteForm($piece);

        return $this->render('piece/show.html.twig', array(
            'piece' => $piece,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing piece entity.
     *
     * @Route("/{id}/edit", name="piece_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Piece $piece)
    {
        $deleteForm = $this->createDeleteForm($piece);
        $editForm = $this->createForm('BackendBundle\Form\PieceType', $piece);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('piece_edit', array('id' => $piece->getId()));
        }

        return $this->render('piece/edit.html.twig', array(
            'piece' => $piece,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a piece entity.
     *
     * @Route("/{id}", name="piece_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Piece $piece)
    {
        $form = $this->createDeleteForm($piece);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($piece);
            $em->flush($piece);
        }

        return $this->redirectToRoute('piece_index');
    }

    /**
     * Creates a form to delete a piece entity.
     *
     * @param Piece $piece The piece entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Piece $piece)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('piece_delete', array('id' => $piece->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
