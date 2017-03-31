<?php

namespace BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GlobalOrder
 *
 * @ORM\Table(name="global_order")
 * @ORM\Entity(repositoryClass="BackendBundle\Repository\GlobalOrderRepository")
 */
class GlobalOrder
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
     * @var \DateTime
     *
     * @ORM\Column(name="date_order", type="datetime")
     */
    private $dateOrder;

    /**
     * @ORM\ManyToOne(targetEntity="User")
     */
    private $user;

    /**
     *  @ORM\Column(name="open", type="boolean")
     */
    private $open;

    /**
     * @ORM\OneToMany(targetEntity="Order_detail", mappedBy="globalOrder")
     */
    private $order_details;

    public function __construct(){
        $this->open = true;
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
     * Set dateOrder
     *
     * @param \DateTime $dateOrder
     *
     * @return GlobalOrder
     */
    public function setDateOrder($dateOrder)
    {
        $this->dateOrder = $dateOrder;

        return $this;
    }

    /**
     * Get dateOrder
     *
     * @return \DateTime
     */
    public function getDateOrder()
    {
        return $this->dateOrder;
    }

    /**
     * Set user
     *
     * @param \BackendBundle\Entity\User $user
     *
     * @return GlobalOrder
     */
    public function setUser(\BackendBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \BackendBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set open
     *
     * @param boolean $open
     *
     * @return GlobalOrder
     */
    public function setOpen($open)
    {
        $this->open = $open;

        return $this;
    }

    /**
     * Get open
     *
     * @return boolean
     */
    public function getOpen()
    {
        return $this->open;
    }

    /**
     * Add orderDetail
     *
     * @param \BackendBundle\Entity\Order_detail $orderDetail
     *
     * @return GlobalOrder
     */
    public function addOrderDetail(\BackendBundle\Entity\Order_detail $orderDetail)
    {
        $this->order_details[] = $orderDetail;

        return $this;
    }

    /**
     * Remove orderDetail
     *
     * @param \BackendBundle\Entity\Order_detail $orderDetail
     */
    public function removeOrderDetail(\BackendBundle\Entity\Order_detail $orderDetail)
    {
        $this->order_details->removeElement($orderDetail);
    }

    /**
     * Get orderDetails
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getOrderDetails()
    {
        return $this->order_details;
    }
}
