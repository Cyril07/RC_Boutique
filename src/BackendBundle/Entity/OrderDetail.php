<?php

namespace BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * OrderDetail
 *
 * @ORM\Table(name="order_detail")
 * @ORM\Entity(repositoryClass="BackendBundle\Repository\OrderDetailRepository")
 */
class OrderDetail
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
     * @ORM\ManyToOne(targetEntity="GlobalOrder")
     */
    private $globalOrder;

    /**
     * @ORM\ManyToOne(targetEntity="Product")
     */
    private $product;


    /**
     * Get id
     *
     * @return integer
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
     * @return OrderDetail
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * Get quantity
     *
     * @return integer
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set globalOrder
     *
     * @param \BackendBundle\Entity\GlobalOrder $globalOrder
     *
     * @return OrderDetail
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

    /**
     * Set product
     *
     * @param \BackendBundle\Entity\Product $product
     *
     * @return OrderDetail
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
}
