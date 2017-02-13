<?php

namespace BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

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
     * @var int
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
     * @ORM\Column(type="string")
     *
     */
    private $picture;

    /**
     * @Assert\NotBlank(message="Please, upload the product brochure as a PDF file.")
     */
    private $picture_file;

    /**
     * @ORM\ManyToOne(targetEntity="Motor")
     */
    private $motor;

    /**
     * @ORM\ManyToOne(targetEntity="Esc")
     */
    private $esc;

    /**
     * @ORM\ManyToOne(targetEntity="Battery")
     */
    private $battery;

    /**
     * @ORM\ManyToOne(targetEntity="Body")
     */
    private $body;

    /**
     * @ORM\ManyToOne(targetEntity="Kit")
     */
    private $kit;

    /**
     * @ORM\ManyToOne(targetEntity="Oil")
     */
    private $oil;

    /**
     * @ORM\ManyToOne(targetEntity="Tires")
     */
    private $tires;

    
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

    /**
     * Set battery
     *
     * @param \BackendBundle\Entity\Battery $battery
     *
     * @return Product
     */
    public function setBattery(\BackendBundle\Entity\Battery $battery = null)
    {
        $this->battery = $battery;

        return $this;
    }

    /**
     * Get battery
     *
     * @return \BackendBundle\Entity\Battery
     */
    public function getBattery()
    {
        return $this->battery;
    }

    /**
     * Set body
     *
     * @param \BackendBundle\Entity\Body $body
     *
     * @return Product
     */
    public function setBody(\BackendBundle\Entity\Body $body = null)
    {
        $this->body = $body;

        return $this;
    }

    /**
     * Get body
     *
     * @return \BackendBundle\Entity\Body
     */
    public function getBody()
    {
        return $this->body;
    }

    /**
     * Set kit
     *
     * @param \BackendBundle\Entity\Kit $kit
     *
     * @return Product
     */
    public function setKit(\BackendBundle\Entity\Kit $kit = null)
    {
        $this->kit = $kit;

        return $this;
    }

    /**
     * Get kit
     *
     * @return \BackendBundle\Entity\Kit
     */
    public function getKit()
    {
        return $this->kit;
    }

    /**
     * Set oil
     *
     * @param \BackendBundle\Entity\Oil $oil
     *
     * @return Product
     */
    public function setOil(\BackendBundle\Entity\Oil $oil = null)
    {
        $this->oil = $oil;

        return $this;
    }

    /**
     * Get oil
     *
     * @return \BackendBundle\Entity\Oil
     */
    public function getOil()
    {
        return $this->oil;
    }

    /**
     * Set tires
     *
     * @param \BackendBundle\Entity\Tires $tires
     *
     * @return Product
     */
    public function setTires(\BackendBundle\Entity\Tires $tires = null)
    {
        $this->tires = $tires;

        return $this;
    }

    /**
     * Get tires
     *
     * @return \BackendBundle\Entity\Tires
     */
    public function getTires()
    {
        return $this->tires;
    }

    /**
     * Set picture
     *
     * @param string $picture
     *
     * @return Product
     */
    public function setPicture($picture)
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * Get picture
     *
     * @return string
     */
    public function getPicture()
    {
        return $this->picture;
    }

    /**
     */
    public function setPictureFile($picture_file = null)
    {
        $this->picture_file = $picture_file;

        return $this;
    }

    /**
     */
    public function getPictureFile()
    {
        return $this->picture_file;
    }
}
