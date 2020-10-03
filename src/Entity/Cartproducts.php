<?php

namespace App\Entity;

use App\Repository\CartproductsRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CartproductsRepository::class)
 */
class Cartproducts
{
    /**
     * @ORM\Id
     * 
     * @ORM\Column(type="integer")
     * GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class="App\Controller\IdGenController")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $quantity;

    /**
     * @ORM\Column(type="integer")
     */
    public $productId;

    /**
     * @ORM\Column(type="integer")
     */
    private $productPrice;

    public function getId(): ?int
    {
        return $this->id;
    }
    public function setId($id)
    {
        $this->id=$id;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): self
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getProductId(): ?int
    {
        return $this->productId;
    }

    public function setProductId(int $productId): self
    {
        $this->productId = $productId;

        return $this;
    }

    public function getProductPrice(): ?int
    {
        return $this->productPrice;
    }

    public function setProductPrice(int $productPrice): self
    {
        $this->productPrice = $productPrice;

        return $this;
    }

}
