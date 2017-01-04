<?php

namespace BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Kit
 *
 * @ORM\Table(name="kit")
 * @ORM\Entity(repositoryClass="BackendBundle\Repository\KitRepository")
 */
class Kit
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
     * @ORM\Column(name="kit_completness", type="boolean")
     */
    private $kitCompletness;

    /**
     * @var bool
     *
     * @ORM\Column(name="terrain", type="boolean")
     */
    private $terrain;

    /**
     * @var bool
     *
     * @ORM\Column(name="drive_train_full", type="boolean")
     */
    private $driveTrainFull;

    /**
     * @ORM\ManyToOne(targetEntity="Scale")
     */
    private $scale;

    /**
     * @ORM\ManyToOne(targetEntity="VehiculeType")
     */
    private $vehiculeType;

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
     * Set kitCompletness
     *
     * @param boolean $kitCompletness
     *
     * @return Kit
     */
    public function setKitCompletness($kitCompletness)
    {
        $this->kitCompletness = $kitCompletness;

        return $this;
    }

    /**
     * Get kitCompletness
     *
     * @return boolean
     */
    public function getKitCompletness()
    {
        return $this->kitCompletness;
    }

    /**
     * Set terrain
     *
     * @param boolean $terrain
     *
     * @return Kit
     */
    public function setTerrain($terrain)
    {
        $this->terrain = $terrain;

        return $this;
    }

    /**
     * Get terrain
     *
     * @return boolean
     */
    public function getTerrain()
    {
        return $this->terrain;
    }

    /**
     * Set driveTrainFull
     *
     * @param boolean $driveTrainFull
     *
     * @return Kit
     */
    public function setDriveTrainFull($driveTrainFull)
    {
        $this->driveTrainFull = $driveTrainFull;

        return $this;
    }

    /**
     * Get driveTrainFull
     *
     * @return boolean
     */
    public function getDriveTrainFull()
    {
        return $this->driveTrainFull;
    }

    /**
     * Set scale
     *
     * @param \BackendBundle\Entity\Scale $scale
     *
     * @return Kit
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
     * Set vehiculeType
     *
     * @param \BackendBundle\Entity\VehiculeType $vehiculeType
     *
     * @return Kit
     */
    public function setVehiculeType(\BackendBundle\Entity\VehiculeType $vehiculeType = null)
    {
        $this->vehiculeType = $vehiculeType;

        return $this;
    }

    /**
     * Get vehiculeType
     *
     * @return \BackendBundle\Entity\VehiculeType
     */
    public function getVehiculeType()
    {
        return $this->vehiculeType;
    }
}
