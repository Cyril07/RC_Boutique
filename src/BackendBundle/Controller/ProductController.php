<?php

namespace BackendBundle\Controller;

use BackendBundle\Entity\Product;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Filesystem\Filesystem;

/**
 * Product controller.
 *
 * @Route("product")
 */
class ProductController extends Controller
{
    /**
     * Lists all product entities.
     *
     * @Route("/", name="product_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $products = $em->getRepository('BackendBundle:Product')->findAll();

        return $this->render('product/index.html.twig', array(
            'products' => $products,
        ));
    }

    /**
     * Creates a new product entity.
     *
     * @Route("/new", name="product_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {

        $product = new Product();

        //$product->getEsc();die('pter');

        $form = $this->createForm('BackendBundle\Form\ProductType', $product);
        $second_category_details = $this->getSubCategories();
        //echo ('<pre>');var_dump($request->request);


        //die('tata');
        $form->handleRequest($request);
        //die('toto');

        if ($form->isSubmitted() && $form->isValid()) {
            //die("cyril");
            $file = $product->getPictureFile();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $product->getPictureFile()->move(
                $this->getParameter('pictures_directory'),
                $fileName
            );

            $product->setPicture($fileName);

            $em = $this->getDoctrine()->getManager();
            $em->persist($product);
            $em->flush($product);

            //return $this->redirect($this->generateUrl('app_product_list'))
            return $this->redirectToRoute('product_show', array('id' => $product->getId()));
        }

        return $this->render('product/new.html.twig', array(
            'product' => $product,
            'second_category_details' => $second_category_details,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a product entity.
     *
     * @Route("/{id}", name="product_show")
     * @Method("GET")
     */
    public function showAction(Product $product)
    {
        $deleteForm = $this->createDeleteForm($product);

        return $this->render('product/show.html.twig', array(
            'product' => $product,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing product entity.
     *
     * @Route("/{id}/edit", name="product_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Product $product)
    {
        $fs = new Filesystem;
        $oldProductFileName = $product->getPicture();
        //Je vérifie que le nom de fichier existe dans la base de données
        if ($product->getPicture()){
        //S'il existe je crée l'objet correspondant à l'image
            $product->setPictureFile(
                new File($this->getParameter('pictures_directory').'/'.$product->getPicture())
            );
            
        }
        //S'il n'existe pas...
        

        $deleteForm = $this->createDeleteForm($product);
        $em=$this->getDoctrine()->getManager();
        
        $second_category_details = $this->getSubCategories();
       

        $editForm = $this->createForm('BackendBundle\Form\ProductType', $product);
        $editForm->handleRequest($request);

        $motorForm = $this->createForm('BackendBundle\Form\MotorType',$product->getMotor());
        $escForm = $this->createForm('BackendBundle\Form\EscType',$product->getEsc());
        $batteryForm = $this->createForm('BackendBundle\Form\BatteryType',$product->getBattery());
        $bodyForm = $this->createForm('BackendBundle\Form\BodyType',$product->getBody());
        $kitForm = $this->createForm('BackendBundle\Form\KitType',$product->getKit());
        $oilForm = $this->createForm('BackendBundle\Form\OilType',$product->getOil());
        $tiresForm = $this->createForm('BackendBundle\Form\TiresType',$product->getTires());


        if ($editForm->isSubmitted() && $editForm->isValid()) 
        {
            //Suppression de l'ancienne image.
            $fs->remove($this->getParameter('pictures_directory').'/'.$oldProductFileName);

            $fileName = md5(uniqid()).'.'.$product->getPictureFile()->guessExtension();
            $product->getPictureFile()->move(
                $this->getParameter('pictures_directory'),
                $fileName
            );
        

            $product->setPicture($fileName);
            $em->persist($product);
            $em->flush();

            return $this->redirectToRoute('product_edit', array('id' => $product->getId()));
        }

        return $this->render('product/edit.html.twig', array(
            'product' => $product,
            'second_category_details' => $second_category_details,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'motor_form' => $motorForm->createView(),

        ));
    }

    /**
     * Deletes a product entity.
     *
     * @Route("/{id}", name="product_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Product $product)
    {
        $form = $this->createDeleteForm($product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($product);
            $em->flush($product);
        }

        return $this->redirectToRoute('product_index');
    }

    /**
     * Creates a form to delete a product entity.
     *
     * @param Product $product The product entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Product $product)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('product_delete', array('id' => $product->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }


    private function getSubCategories(){

        $em=$this->getDoctrine()->getManager();
        $ret = [];
        $ret['motors'] = $em->getRepository('BackendBundle:Motor')->findAll();
        $ret['escs'] = $em->getRepository('BackendBundle:Esc')->findAll();
        $ret['batteries'] = $em->getRepository('BackendBundle:Battery')->findAll();
        $ret['bodies'] = $em->getRepository('BackendBundle:Body')->findAll();
        $ret['kits'] = $em->getRepository('BackendBundle:Kit')->findAll();
        $ret['oils'] = $em->getRepository('BackendBundle:Oil')->findAll();
        $ret['tires'] = $em->getRepository('BackendBundle:Tires')->findAll();

        return $ret;
    }
}
