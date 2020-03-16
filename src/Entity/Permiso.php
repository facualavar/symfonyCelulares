<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PermisoRepository")
 */
class Permiso
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $seccion;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSeccion(): ?string
    {
        return $this->seccion;
    }

    public function setSeccion(string $seccion): self
    {
        $this->seccion = $seccion;

        return $this;
    }
}
