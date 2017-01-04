<?php

namespace BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Motor
 *
 * @ORM\Table(name="motor")
 * @ORM\Entity(repositoryClass="BackendBundle\Repository\MotorRepository")
 */
class Motor
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
     * @ORM\Column(name="sensored", type="boolean")
     */
    private $sensored;

    /**
     * @var bool
     *
     * @ORM\Column(name="brushless", type="boolean")
     */
    private $brushless;

    /**
     * @ORM\ManyToOne(targetEntity="Scale")
     */
    private $scale;

    /**
     * @ORM\ManyToOne(targetEntity="MotorTurns")
     */
    private $motorTurns;


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
     * Set sensored
     *
     * @param boolean $sensored
     *
     * @return Motor
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
     * Set brushless
     *
     * @param boolean $brushless
     *
     * @return Motor
     */
    public function setBrushless($brushless)
    {
        $this->brushless = $brushless;

        return $this;
    }

    /**
     * Get brushless
     *
     * @return boolean
     */
    public function getBrushless()
    {
        return $this->brushless;
    }

    /**
     * Set scale
     *
     * @param \BackendBundle\Entity\Scale $scale
     *
     * @return Motor
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
     * Set motorTurns
     *
     * @param \BackendBundle\Entity\MotorTurns $motorTurns
     *
     * @return Motor
     */
    public function setMotorTurns(\BackendBundle\Entity\MotorTurns $motorTurns = null)
    {
        $this->motorTurns = $motorTurns;

        return $this;
    }

    /**
     * Get motorTurns
     *
     * @return \BackendBundle\Entity\MotorTurns
     */
    public function getMotorTurns()
    {
        return $this->motorTurns;
    }
}
