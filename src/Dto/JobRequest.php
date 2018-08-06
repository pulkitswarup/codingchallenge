<?php

namespace App\Dto;

use JMS\Serializer\Annotation\Type;
use Symfony\Component\Validator\Constraints as Assert;

class JobRequest
{
    /**
     * @var string
     * @Type("string")
     * @Assert\NotBlank()
     * @Assert\Type(type = "string")
     * @Assert\Length(min = 5, max = 50)
     */
    private $title;

    /**
     * @var string
     * @Type("string")
     * @Assert\NotBlank()
     * @Assert\Type(type = "string")
     * @Assert\Length(min = 10, max = 255)
     */
    private $description;

    /**
     * @var integer
     * @Type("integer")
     * @Assert\NotBlank()
     * @Assert\Type(type = "integer")
     */
    private $city;

    /**
     * @var integer
     * @Type("integer")
     * @Assert\NotBlank()
     * @Assert\Type(type = "integer")
     */
    private $zip_code;

    /**
     * @var \DateTimeInterface
     * @Type("DateTime<'Y-m-d H:i:s'>")
     * @Assert\NotBlank()
     * @Assert\DateTime()
     * @Assert\Range(min="+30 minutes", max="+3 months")
     */
    private $execute_at;

    /**
     * @var integer
     * @Type("integer")
     * @Assert\NotBlank()
     * @Assert\Type(type = "integer")
     */
    private $category;

    /**
     * Returns the title of the job
     *
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Sets the title of the job
     *
     * @param string $title
     *
     * @return self
     */
    public function setTitle(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    /**
     * Returns the description of the job
     *
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Sets the description of the job
     *
     * @param string $description
     *
     * @return self
     */
    public function setDescription(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    /**
     * Returns the zip code of the job
     *
     * @return int
     */
    public function getZipCode(): int
    {
        return $this->zip_code;
    }

    /**
     * Sets the zip code of the job
     *
     * @param int $zip_code
     *
     * @return self
     */
    public function setZipCode(int $zip_code): self
    {
        $this->zip_code = $zip_code;
        return $this;
    }

    /**
     * Return the executed at of the job
     *
     * @return \DateTimeInterface
     */
    public function getExecuteAt()
    {
        return $this->execute_at;
    }

    /**
     * Sets the executed at of the job
     *
     * @param \DateTimeInterface $execute_at
     *
     * @return self
     */
    public function setExecuteAt(\DateTimeInterface $execute_at): self
    {
        $this->execute_at = $execute_at;
        return $this;
    }

    /**
     * Return the category of the job
     *
     * @return integer
     */
    public function getCategory(): int
    {
        return $this->category;
    }

    /**
     * Sets the category of the job
     *
     * @param integer $category
     *
     * @return self
     */
    public function setCategory(int $category): self
    {
        $this->category = $category;
        return $this;
    }

    /**
     * Returns the city of the job
     *
     * @return integer
     */
    public function getCity(): int
    {
        return $this->city;
    }

    /**
     * Sets the city of the job
     *
     * @param integer $city
     *
     * @return self
     */
    public function setCity(int $city): self
    {
        $this->city = $city;
        return $this;
    }
}
