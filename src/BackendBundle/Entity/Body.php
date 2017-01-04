<?php

namespace BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Body
 *
 * @ORM\Table(name="body")
 * @ORM\Entity(repositoryClass="BackendBundle\Repository\BodyRepository")
 */
class Body
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
     * @ORM\Column(name="paint", type="boolean")
     */
    private $paint;

    /**
     * @ORM\ManyToOne(targetEntity="Scale")
     */
    private $scale;


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
     * Set paint
     *
     * @param boolean $paint
     *
     * @return Body
     */
    public function setPaint($paint)
    {
        $this->paint = $paint;

        return $this;
    }

    /**
     * Get paint
     *
     * @return bool
     */
    public function getPaint()
    {
        return $this->paint;
    }

    /**
     * Set scale
     *
     * @param \BackendBundle\Entity\Scale $scale
     *
     * @return Body
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
}
