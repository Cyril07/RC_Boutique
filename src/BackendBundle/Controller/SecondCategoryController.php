<?php

namespace BackendBundle\Controller;

use BackendBundle\Entity\SecondCategory;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


/**
 * Secondcategory controller.
 *
 * @Route("secondcategory")
 */
class SecondCategoryController extends Controller
{

    /**
     * @Route("/json_category", name="json_category")
     * @Method("POST")
     */
    public function jsonAction(Request $request)
    {   
        $em = $this->getDoctrine()->getManager();
        $request_category_id = $request->request->get("category_id");
        //var_dump("categoryid",$request_category_id);
        $category = $em->getRepository("BackendBundle:Category")->find($request_category_id);
        $second_categories_after_select = $em->getRepository("BackendBundle:SecondCategory")->findByCategory($category);
        //var_dump(json_encode($second_category_after_select));
        //return;
        $rep = [];
        foreach ($second_categories_after_select as $second_category) {
            $rep[] = array(
                "id"=>$second_category->getId(),
                "lib"=>$second_category->getLib(),
            );
        }

        return new Response(json_encode($rep));
    }

    
    /**
     * Lists all secondCategory entities.
     *
     * @Route("/", name="secondcategory_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $secondCategories = $em->getRepository('BackendBundle:SecondCategory')->findAll();

        return $this->render('secondcategory/index.html.twig', array(
            'secondCategories' => $secondCategories,
        ));
    }

    /**
     * Creates a new secondCategory entity.
     *
     * @Route("/new", name="secondcategory_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $secondCategory = new Secondcategory();
        $form = $this->createForm('BackendBundle\Form\SecondCategoryType', $secondCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($secondCategory);
            $em->flush($secondCategory);

            return $this->redirectToRoute('secondcategory_show', array('id' => $secondCategory->getId()));
        }

        return $this->render('secondcategory/new.html.twig', array(
            'secondCategory' => $secondCategory,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a secondCategory entity.
     *
     * @Route("/{id}", name="secondcategory_show")
     * @Method("GET")
     */
    public function showAction(SecondCategory $secondCategory)
    {
        $deleteForm = $this->createDeleteForm($secondCategory);

        return $this->render('secondcategory/show.html.twig', array(
            'secondCategory' => $secondCategory,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing secondCategory entity.
     *
     * @Route("/{id}/edit", name="secondcategory_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, SecondCategory $secondCategory)
    {
        $deleteForm = $this->createDeleteForm($secondCategory);
        $editForm = $this->createForm('BackendBundle\Form\SecondCategoryType', $secondCategory);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('secondcategory_edit', array('id' => $secondCategory->getId()));
        }

        return $this->render('secondcategory/edit.html.twig', array(
            'secondCategory' => $secondCategory,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a secondCategory entity.
     *
     * @Route("/{id}", name="secondcategory_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, SecondCategory $secondCategory)
    {
        $form = $this->createDeleteForm($secondCategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($secondCategory);
            $em->flush($secondCategory);
        }

        return $this->redirectToRoute('secondcategory_index');
    }

    /**
     * Creates a form to delete a secondCategory entity.
     *
     * @param SecondCategory $secondCategory The secondCategory entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(SecondCategory $secondCategory)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('secondcategory_delete', array('id' => $secondCategory->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
