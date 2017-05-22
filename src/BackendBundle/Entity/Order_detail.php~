<?php

namespace BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Order_detail
 *
 * @ORM\Table(name="order_detail")
 * @ORM\Entity(repositoryClass="BackendBundle\Repository\Order_detailRepository")
 */
class Order_detail
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="quantity", type="integer")
     */
    private $quantity;

    /**
     * @ORM\ManyToOne(targetEntity="Product")
     */
    private $product;

    /**
     * @ORM\ManyToOne(targetEntity="GlobalOrder")
     */
    private $globalOrder;


    public function incQuantity() {
        $this->quantity++;
    }


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set quantity
     *
     * @param integer $quantity
     *
     * @return Order_detail
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set product
     *
     * @param \BackendBundle\Entity\Product $product
     *
     * @return Order_detail
     */
    public function setProduct(\BackendBundle\Entity\Product $product = null)
    {
        $this->product = $product;

        return $this;
    }

    /**
     * Get product
     *
     * @return \BackendBundle\Entity\Product
     */
    public function getProduct()
    {
        return $this->product;
    }

    /**
     * Set globalOrder
     *
     * @param \BackendBundle\Entity\GlobalOrder $globalOrder
     *
     * @return Order_detail
     */
    public function setGlobalOrder(\BackendBundle\Entity\GlobalOrder $globalOrder = null)
    {
        $this->globalOrder = $globalOrder;

        return $this;
    }

    /**
     * Get globalOrder
     *
     * @return \BackendBundle\Entity\GlobalOrder
     */
    public function getGlobalOrder()
    {
        return $this->globalOrder;
    }
}
