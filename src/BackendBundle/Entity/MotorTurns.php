<?php

namespace BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MotorTurns
 *
 * @ORM\Table(name="motor_turns")
 * @ORM\Entity(repositoryClass="BackendBundle\Repository\MotorTurnsRepository")
 */
class MotorTurns
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
     * @var int
     *
     * @ORM\Column(name="turns", type="decimal",scale=1, unique=true)
     */
    private $turns;

    public function __toString() {
        return $this->turns;
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
     * Set turns
     *
     * @param integer $turns
     *
     * @return MotorTurns
     */
    public function setTurns($turns)
    {
        $this->turns = $turns;

        return $this;
    }

    /**
     * Get turns
     *
     * @return int
     */
    public function getTurns()
    {
        return $this->turns;
    }
}
