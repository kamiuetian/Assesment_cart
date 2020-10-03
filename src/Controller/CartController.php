<?php

namespace App\Controller;
use App\Entity\Products;
use App\Entity\Cartproducts;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CartController extends AbstractController
{
    /**
     * @Route("/", name="cart")
     */
    public function index()
    {
        $new_products=array();
        $total=0;
        $products = $this->getDoctrine()
        ->getRepository(Cartproducts::class)
        ->findAll();
        foreach($products as $p)
        {
            $total+=$p->getproductPrice();
        }
       return $this->render('cart/index.html.twig', array('products' => $products,'totalPrice'=>$total));
    }
    /**
    * @Route("/add-to-cart", name="add_to_cart")
    */
    public function addItemToCart(Request $request)
    {
        $response=array();
        $total=0;
        $productId=(int)$request->request->get('id');
        $productName=$request->request->get('productname');
        $productPrice=10;
        $productQuantity=1;//$request->request->get('productquantity');
        $entityManager = $this->getDoctrine()->getManager();
        $product = $this->getDoctrine()->getRepository(Cartproducts::class)
        ->findOneBySomeField($productId);
        
        if (!$product) {
            $product_added = new Cartproducts();
            $product_added->setId(str_pad(rand(0, pow(10, 5)-1), 5, '0', STR_PAD_LEFT));
        $product_added->setQuantity($productQuantity);
        $product_added->setProductId((int)$productId);
        $product_added->setProductPrice(10);

        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($product_added);

        // actually executes the queries (i.e. the INSERT query)
        $entityManager->flush();
        }
        else{
            $product->setQuantity($product->getQuantity()+$productQuantity);
        $product->setProductPrice($product->getQuantity()*$productPrice);
        $entityManager->flush();
        }
        $products = $this->getDoctrine()
        ->getRepository(Cartproducts::class)
        ->findAll();
        foreach($products as $p)
        {
            $total+=$p->getproductPrice();
          
        }
        $response['products']=$products;
        $response['total']=$total;
        return $this->json($response);
        
            }
    /**
    * @Route("/update-cart-item", name="update_cart_item", methods={"POST"})
    */    
    public function updateItemQuantity(Request $request)
    {
        $response=array();
        $total=0;
        $productId=$request->request->get('id');
        $quantity=$request->request->get('quantity');
        $productprice=10;
        $product = $this->getDoctrine()->getRepository(Cartproducts::class)
        ->findOneBySomeField($productId);
        $entityManager = $this->getDoctrine()->getManager();
        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }
    
        $product->setQuantity($quantity);
        $product->setProductPrice($quantity*$productprice);
        $entityManager->flush();
    
        $products = $this->getDoctrine()
        ->getRepository(Cartproducts::class)
        ->findAll();
        foreach($products as $p)
        {
            $total+=$p->getproductPrice();
          
        }
        $response['products']=$products;
        $response['total']=$total;
        return $this->json($response);
    }
    /**
    * @Route("/delete-cart-item", name="delete_cart_item")
    */
    public function deleteItem(Request $request)
    {
        $response=array();
        $total=0;
    	$productId=(int)$request->request->get('id');
        $product = $this->getDoctrine()->getRepository(Cartproducts::class)
        ->findOneBySomeField($productId);
        $entityManager = $this->getDoctrine()->getManager();
        if (!$product) {
            throw $this->createNotFoundException(
                'No product found for id '.$id
            );
        }
        $entityManager->remove($product);
        $entityManager->flush();
        $products = $this->getDoctrine()
        ->getRepository(Cartproducts::class)
        ->findAll();
        foreach($products as $p)
        {
            $total+=$p->getproductPrice();
          
        }
        $response['products']=$products;
        $response['total']=$total;
        return $this->json($response);
        
    }
    
    /**
     * @Route("/complete", name="autocompleteSearch")
     */
    public function autocompleteSearch(Request $request)
    {
        $query=$request->request->get('search_query');
        
        $products = $this->getDoctrine()->getRepository(Products::class)->findByExampleField($query);
            
            return $this->json($products);
    }
    
}
