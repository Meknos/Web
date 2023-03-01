<?php

namespace App\Entity;

use App\Repository\AuthorofbookRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AuthorofbookRepository::class)
 */
class Authorofbook
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $bookid;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBookid(): ?int
    {
        return $this->bookid;
    }

    public function setBookid(int $bookid): self
    {
        $this->bookid = $bookid;

        return $this;
    }
}
