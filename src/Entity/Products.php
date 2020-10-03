<?php

namespace App\Entity;

use App\Repository\ProductsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProductsRepository::class)
 */
class Products
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     * 
     * 
     */
    private $id;
    /**
     * @ORM\Column(type="string", length=255)
     */
    public $product_name;
    /**
     * @ORM\Column(type="text")
     */
    public $product_img;
    /**
     * @ORM\Column(type="integer")
     */
    public $product_price;
    /**getter for Id */
    public function getId(): ?int
    {
        return $this->id;
    }
    /**getter/setters for product name */
    public function getProduct_name()
    {
        return $this->product_name;
    }
    public function setProduct_name($pname)
    {
       $this->product_name=$pname;
    }
     /**getter/setters for product price */
     public function getProduct_price()
     {
         return $this->product_price;
     }
     public function setProduct_price($pprice)
     {
        $this->product_price=$pprice;
     }
      /**getter/setters for product name */
    public function getProduct_img()
    {
        return $this->product_img;
    }
    public function setProduct_img($pimg)
    {
       $this->product_img=$pimg;
    }

    public function getProductName(): ?string
    {
        return $this->product_name;
    }

    public function setProductName(string $product_name): self
    {
        $this->product_name = $product_name;

        return $this;
    }

    public function getProductImg(): ?string
    {
        return $this->product_img;
    }

    public function setProductImg(string $product_img): self
    {
        $this->product_img = $product_img;

        return $this;
    }

    public function getProductPrice(): ?int
    {
        return $this->product_price;
    }

    public function setProductPrice(int $product_price): self
    {
        $this->product_price = $product_price;

        return $this;
    }



}
