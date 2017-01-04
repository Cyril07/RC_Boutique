<?php

namespace BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Esc
 *
 * @ORM\Table(name="esc")
 * @ORM\Entity(repositoryClass="BackendBundle\Repository\EscRepository")
 */
class Esc
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
     * @var bool
     *
     * @ORM\Column(name="waterproof", type="boolean")
     */
    private $waterproof;

    /**
     * @var bool
     *
     * @ORM\Column(name="sensored", type="boolean")
     */
    private $sensored;

    /**
     * @ORM\ManyToOne(targetEntity="Scale")
     */
    private $scale;

    /**
     * @ORM\ManyToOne(targetEntity="Power")
     */
    private $power;


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
     * Set waterproof
     *
     * @param boolean $waterproof
     *
     * @return Esc
     */
    public function setWaterproof($waterproof)
    {
        $this->waterproof = $waterproof;

        return $this;
    }

    /**
     * Get waterproof
     *
     * @return bool
     */
    public function getWaterproof()
    {
        return $this->waterproof;
    }

    /**
     * Set sensored
     *
     * @param boolean $sensored
     *
     * @return Esc
     */
    public function setSensored($sensored)
    {
        $this->sensored = $sensored;

        return $this;
    }

    /**
     * Get sensored
     *
     * @return bool
     */
    public function getSensored()
    {
        return $this->sensored;
    }

    /**
     * Set scale
     *
     * @param \BackendBundle\Entity\Scale $scale
     *
     * @return Esc
     */
    public function setScale(\BackendBundle\Entity\Scale $scale = null)
    {
        $this->scale = $scale;

        return $this;
    }

    /**
     * Get scale
     *
     * @return \BackendBundle\Entity\Scale
     */
    public function getScale()
    {
        return $this->scale;
    }

    /**
     * Set power
     *
     * @param \BackendBundle\Entity\Power $power
     *
     * @return Esc
     */
    public function setPower(\BackendBundle\Entity\Power $power = null)
    {
        $this->power = $power;

        return $this;
    }

    /**
     * Get power
     *
     * @return \BackendBundle\Entity\Power
     */
    public function getPower()
    {
        return $this->power;
    }
}
