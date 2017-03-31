/**
     * @Route("/add", name="order_detail_add")
     * @Method({"GET", "POST"})
     */ 

    public function addOrder_detailAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $request_product_id = $request->request->get('product_id');
        $request_user_id = $request->request->get('user_id');

        $product = $em->getRepository("BackendBundle:Product")->find($request_product_id);
        $user = $em->getRepository("BackendBundle:User")->find($request_user_id);

        $globalOrder = $em->getRepository('BackendBundle:Global_order')->findByUser($user);

        if ($globalOrder) {

            $order_detail = new Order_detail ();
            $order_detail->setProduct($product);
            $order_detail->setUser($user);
            $order_detail->setQuantity(1);

            $em->persist($order_detail);
            $em->flush();
        }
        
        else{

            $globalOrder = new Globalorder();
            $globalOrder->setUser($user);
            $globalOrder->setOrder_detail();

        }

        return new Response();        
    }


    /**
     * @Route("/delete", name="order_detail_delete")
     * @Method({"GET", "POST"})
     */ 

    public function deleteOrder_detailAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $request_order_detail_id = $request->request->get('order_detail_id');
        $request_user_id = $request->request->get('user_id');
        //echo $request_order_id;die;
        $order_detail = $em->getRepository("BackendBundle:Order_detail")->find($request_order_detail_id);
        $user = $em->getRepository("BackendBundle:User")->find($request_user_id);

        $em->remove($order_detail);
        $em->flush();

        return new Response();        
    }

    /**
     * @Route("/", name="order_detail")
     * @Method("GET")
     */

    public function order_detailAction()
    {   
        $em = $this->getDoctrine()->getManager();

        $securityContext = $this->container->get('security.authorization_checker');        

        if ($securityContext->isGranted('IS_AUTHENTICATED_REMEMBERED')) {
            $user = $this->get('security.token_storage')->getToken()->getUser()->getId();

            $order_details = $em->getRepository("BackendBundle:Order_detail")->findByUser($user);            

            return $this->render('FrontendBundle::shopping_cart.html.twig', array(
                'order_details' => $order_details,
            ));
        }

        return $this->render('FrontendBundle::shopping_cart.html.twig');
    }

    /**
     * @Route("/quantity_order_detail", name="quantity_order_detail")
     * @Method({"GET", "POST"})
     */ 

    public function quantityOrder_detailAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $quantity = $request->request->get('quantity');

        $request_user_id = $request->request->get('user_id');
        $request_order_detail_id = $request->request->get('order_detail_id');
        $request_product_id = $request->request->get('product_id');

        $order_detail = $em->getRepository('BackendBundle:Order_detail')->find($request_order_detail_id);
        $product = $em->getRepository('BackendBundle:Product')->find($request_product_id);

        $order_details = $em->getRepository('BackendBundle:Order_detail')->findAll();

        $order_detail = $em->getRepository('BackendBundle:Order_detail')
            ->getOrder_detailForOneProduct($order_detail,$product);


        if ($order_detail) {
            $order_detail->setQuantity($quantity);
            $em->persist($order_detail);
            $em->flush();
        }

        else {
            $order_detail = new Order_detail();
            $order_detail->setQuantity($quantity);
            //$order_detail->setUser($user);
            $order_detail->setProduct($product);
            $em->persist($order_detail);
            $em->flush();
        }
        
        return new Response();
    }

    private function total_order_detail($order_detail_id){

        $em = $this->getDoctrine()->getManager();

        $tot = $em->getRepository('BackendBundle:Order_detail')->total_order_detail($order_detail_id);

    }