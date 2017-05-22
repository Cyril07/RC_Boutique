<?php

namespace BackendBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Brand
 *
 * @ORM\Table(name="brand")
 * @ORM\Entity(repositoryClass="BackendBundle\Repository\BrandRepository")
 */
class Brand
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
     * @ORM\Column(name="short_lib", type="string", length=20)
     */
    private $shortLib;

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
     * @return Brand
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
     * Set shortLib
     *
     * @param string $shortLib
     *
     * @return Brand
     */
    public function setShortLib($shortLib)
    {
        $this->shortLib = $shortLib;

        return $this;
    }

    /**
     * Get shortLib
     *
     * @return string
     */
    public function getShortLib()
    {
        return $this->shortLib;
    }
}
