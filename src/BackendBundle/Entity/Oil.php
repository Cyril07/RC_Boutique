<?php

namespace BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Oil
 *
 * @ORM\Table(name="oil")
 * @ORM\Entity(repositoryClass="BackendBundle\Repository\OilRepository")
 */
class Oil
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
     * @ORM\ManyToOne(targetEntity="Wt")
     */
    private $wt;


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
     * Set wt
     *
     * @param \BackendBundle\Entity\Wt $wt
     *
     * @return Oil
     */
    public function setWt(\BackendBundle\Entity\Wt $wt = null)
    {
        $this->wt = $wt;

        return $this;
    }

    /**
     * Get wt
     *
     * @return \BackendBundle\Entity\Wt
     */
    public function getWt()
    {
        return $this->wt;
    }
}
