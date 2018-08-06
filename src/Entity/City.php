<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CityRepository")
 * @ORM\Table(
 *      indexes={
 *          @ORM\Index(columns={"country_id"}),
 *          @ORM\Index(columns={"zip_code"})
 *      }
 * )
 */
class City
{
    /**
     * @var integer
     * @ORM\Id()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var \App\Entity\Country
     * @ORM\ManyToOne(targetEntity="App\Entity\Country", cascade={"persist"})
     * @ORM\JoinColumn(name="country_id", referencedColumnName="id", nullable=false)
     */
    private $country;

    /**
     * @var integer
     * @ORM\Column(type="integer")
     */
    private $zip_code;

    /**
     * @var string
     * @ORM\Column(type="string", length=100)
     */
    private $name;

    public function setId(int $id)
    {
        $this->id = $id;
        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function getCountry(): ?Country
    {
        return $this->country;
    }

    public function setCountry(?Country $country): self
    {
        $this->country = $country;
        return $this;
    }

    public function getZipCode(): ?int
    {
        return $this->zip_code;
    }

    public function setZipCode(int $zip_code): self
    {
        $this->zip_code = $zip_code;
        return $this;
    }
}
