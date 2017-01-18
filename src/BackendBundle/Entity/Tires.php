<?php

namespace BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tires
 *
 * @ORM\Table(name="tires")
 * @ORM\Entity(repositoryClass="BackendBundle\Repository\TiresRepository")
 */
class Tires
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
     * @ORM\Column(name="Front_wheel_position", type="boolean")
     */
    private $frontWheelPosition;

    /**
     * @ORM\ManyToOne(targetEntity="Scale")
     */
    private $scale;

    /**
     * @ORM\ManyToOne(targetEntity="TiresColor")
     */
    private $tiresColor;

    public function __toString() {
        return strval($this->id);
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
     * Set frontWheelPosition
     *
     * @param boolean $frontWheelPosition
     *
     * @return Tires
     */
    public function setFrontWheelPosition($frontWheelPosition)
    {
        $this->frontWheelPosition = $frontWheelPosition;

        return $this;
    }

    /**
     * Get frontWheelPosition
     *
     * @return bool
     */
    public function getFrontWheelPosition()
    {
        return $this->frontWheelPosition;
    }

    /**
     * Set scale
     *
     * @param \BackendBundle\Entity\Scale $scale
     *
     * @return Tires
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
     * Set tiresColor
     *
     * @param \BackendBundle\Entity\TiresColor $tiresColor
     *
     * @return Tires
     */
    public function setTiresColor(\BackendBundle\Entity\TiresColor $tiresColor = null)
    {
        $this->tiresColor = $tiresColor;

        return $this;
    }

    /**
     * Get tiresColor
     *
     * @return \BackendBundle\Entity\TiresColor
     */
    public function getTiresColor()
    {
        return $this->tiresColor;
    }
}
