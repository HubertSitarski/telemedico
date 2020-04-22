<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Class BaseEntity
 * @package App\Entity
 * @ORM\MappedSuperclass()
 */
class BaseEntity
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    public function getId(): ?int
    {
        return $this->id;
    }
}
