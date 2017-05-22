<?php

namespace BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SecondCategory
 *
 * @ORM\Table(name="second_category")
 * @ORM\Entity(repositoryClass="BackendBundle\Repository\SecondCategoryRepository")
 */
class SecondCategory
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
     * @ORM\Column(name="lib", type="string", length=50)
     */
    private $lib;

    /**
     * @var string
     *
     * @ORM\Column(name="div_name", type="string", length=25)
     */
    private $div_name;

    /**
     * @ORM\ManyToOne(targetEntity="Category")
     */
    private $category;

    public function __toString() {
        return $this->lib;
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
     * Set lib
     *
     * @param string $lib
     *
     * @return SecondCategory
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
     * Set category
     *
     * @param \BackendBundle\Entity\Category $category
     *
     * @return SecondCategory
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
     * Set divName
     *
     * @param string $divName
     *
     * @return SecondCategory
     */
    public function setDivName($divName)
    {
        $this->div_name = $divName;

        return $this;
    }

    /**
     * Get divName
     *
     * @return string
     */
    public function getDivName()
    {
        return $this->div_name;
    }
}
