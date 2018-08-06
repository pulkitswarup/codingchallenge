<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\JobRepository")
 * @ORM\Table(
 *      indexes={
 *          @ORM\Index(columns={"city_id"}),
 *          @ORM\Index(columns={"zip_code"}),
 *          @ORM\Index(columns={"category_id"}),
 *          @ORM\Index(columns={"execute_at"}),
 *          @ORM\Index(columns={"created_at"}),
 *          @ORM\Index(columns={"updated_at"}),
 *          @ORM\Index(columns={"title"}, flags={"fulltext"})
 *      }
 * )
 * @ORM\HasLifecycleCallbacks
 */
class Job
{
    /**
     * @var integer
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     * @ORM\Column(type="string", length=50)
     */
    private $title;

    /**
     * @var string
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @var \App\Entity\City
     * @ORM\ManyToOne(targetEntity="App\Entity\City")
     * @ORM\JoinColumn(name="city_id", referencedColumnName="id", nullable=false)
     */
    private $city;

    /**
     * @var integer
     * @ORM\Column(name="zip_code", type="integer")
     */
    private $zip_code;

    /**
     * @var \DateTimeInterface
     * @ORM\Column(type="datetime")
     */
    private $execute_at;

    /**
     * @var \App\Entity\Category
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", cascade={"persist"})
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id", nullable=false)
     */
    private $category;

    /**
     * @var \DateTimeInterface
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @var \DateTimeInterface
     * @ORM\Column(type="datetime")
     */
    private $updated_at;

    public function setId(int $id)
    {
        $this->id = $id;
        return $this;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getZipCode(): int
    {
        return $this->zip_code;
    }

    public function setZipCode(int $zip_code): self
    {
        $this->zip_code = $zip_code;
        return $this;
    }

    public function getExecuteAt(): \DateTimeInterface
    {
        return $this->execute_at;
    }

    public function setExecuteAt(\DateTimeInterface $execute_at): self
    {
        $this->execute_at = $execute_at;
        return $this;
    }

    public function getCategory(): Category
    {
        return $this->category;
    }

    public function setCategory(Category $category): self
    {
        $this->category = $category;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    public function getCity(): ?City
    {
        return $this->city;
    }

    public function setCity(City $city): self
    {
        $this->city = $city;

        return $this;
    }

    /**
     * This method updates the timestamps for the entity
     * @ORM\PrePersist
     * @ORM\PreUpdate
     *
     * @return void
     */
    public function updateTimestamps() : void
    {
        $this->setUpdatedAt(new \DateTime('now'));

        if ($this->getCreatedAt() == null) {
            $this->setCreatedAt(new \DateTime('now'));
        }
    }
}
