<?php

namespace BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Battery
 *
 * @ORM\Table(name="battery")
 * @ORM\Entity(repositoryClass="BackendBundle\Repository\BatteryRepository")
 */
class Battery
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
     * @ORM\Column(name="capacity", type="string", length=50)
     */
    private $capacity;

    /**
     * @ORM\ManyToOne(targetEntity="CellCount")
     */
    private $cellCount;

    /**
     * @ORM\ManyToOne(targetEntity="BatteryType")
     */
    private $batteryType;

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
     * Set capacity
     *
     * @param string $capacity
     *
     * @return Battery
     */
    public function setCapacity($capacity)
    {
        $this->capacity = $capacity;

        return $this;
    }

    /**
     * Get capacity
     *
     * @return string
     */
    public function getCapacity()
    {
        return $this->capacity;
    }

    /**
     * Set cellCount
     *
     * @param \BackendBundle\Entity\CellCount $cellCount
     *
     * @return Battery
     */
    public function setCellCount(\BackendBundle\Entity\CellCount $cellCount = null)
    {
        $this->cellCount = $cellCount;

        return $this;
    }

    /**
     * Get cellCount
     *
     * @return \BackendBundle\Entity\CellCount
     */
    public function getCellCount()
    {
        return $this->cellCount;
    }

    /**
     * Set batteryType
     *
     * @param \BackendBundle\Entity\BatteryType $batteryType
     *
     * @return Battery
     */
    public function setBatteryType(\BackendBundle\Entity\BatteryType $batteryType = null)
    {
        $this->batteryType = $batteryType;

        return $this;
    }

    /**
     * Get batteryType
     *
     * @return \BackendBundle\Entity\BatteryType
     */
    public function getBatteryType()
    {
        return $this->batteryType;
    }
}
