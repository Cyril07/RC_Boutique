<?php

namespace BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Product
 *
 * @ORM\Table(name="product")
 * @ORM\Entity(repositoryClass="BackendBundle\Repository\ProductRepository")
 */
class Product
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
     * @var string
     *
     * @ORM\Column(name="ref", type="string", length=50, unique=true)
     */
    private $ref;

    /**
     * @var string
     *
     * @ORM\Column(name="price", type="decimal")
     */
    private $price;

    /**
     * @var string
     *
     * @ORM\Column(name="lib", type="string", length=255)
     */
    private $lib;

    /**
     * @ORM\ManyToOne(targetEntity="Brand")
     */
    private $brand;

    /**
     * @ORM\ManyToOne(targetEntity="Category")
     */
    private $category;

    /**
     * @ORM\ManyToOne(targetEntity="SecondCategory")
     */
    private $secondCategory;

    /**
     * @ORM\ManyToOne(targetEntity="Motor")
     */
    private $motor;

    /**
     * @ORM\ManyToOne(targetEntity="Esc")
     */
    private $esc;




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
     * Set ref
     *
     * @param string $ref
     *
     * @return Product
     */
    public function setRef($ref)
    {
        $this->ref = $ref;

        return $this;
    }

    /**
     * Get ref
     *
     * @return string
     */
    public function getRef()
    {
        return $this->ref;
    }

    /**
     * Set price
     *
     * @param string $price
     *
     * @return Product
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return string
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set lib
     *
     * @param string $lib
     *
     * @return Product
     */
    public function setLib($lib)
    {
        $this->lib = $lib;

        return $this;
    }

    /**
     * Get lib
     *
     * @return string
     */
    public function getLib()
    {
        return $this->lib;
    }

    /**
     * Set brand
     *
     * @param \BackendBundle\Entity\Brand $brand
     *
     * @return Product
     */
    public function setBrand(\BackendBundle\Entity\Brand $brand = null)
    {
        $this->brand = $brand;

        return $this;
    }

    /**
     * Get brand
     *
     * @return \BackendBundle\Entity\Brand
     */
    public function getBrand()
    {
        return $this->brand;
    }

    /**
     * Set category
     *
     * @param \BackendBundle\Entity\Category $category
     *
     * @return Product
     */
    public function setCategory(\BackendBundle\Entity\Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \BackendBundle\Entity\Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set secondCategory
     *
     * @param \BackendBundle\Entity\SecondCategory $secondCategory
     *
     * @return Product
     */
    public function setSecondCategory(\BackendBundle\Entity\SecondCategory $secondCategory = null)
    {
        $this->secondCategory = $secondCategory;

        return $this;
    }

    /**
     * Get secondCategory
     *
     * @return \BackendBundle\Entity\SecondCategory
     */
    public function getSecondCategory()
    {
        return $this->secondCategory;
    }

    /**
     * Set motor
     *
     * @param \BackendBundle\Entity\Motor $motor
     *
     * @return Product
     */
    public function setMotor(\BackendBundle\Entity\Motor $motor = null)
    {
        $this->motor = $motor;

        return $this;
    }

    /**
     * Get motor
     *
     * @return \BackendBundle\Entity\Motor
     */
    public function getMotor()
    {
        return $this->motor;
    }

    /**
     * Set esc
     *
     * @param \BackendBundle\Entity\Esc $esc
     *
     * @return Product
     */
    public function setEsc(\BackendBundle\Entity\Esc $esc = null)
    {
        $this->esc = $esc;

        return $this;
    }

    /**
     * Get esc
     *
     * @return \BackendBundle\Entity\Esc
     */
    public function getEsc()
    {
        return $this->esc;
    }
}
