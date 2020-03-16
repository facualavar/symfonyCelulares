<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CategoriaRepository")
 */
class Categoria
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nombre;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Producto", mappedBy="categoria")
     */
    private $productos;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\SubCategoria", mappedBy="categoria")
     */
    private $subCategorias;

    public function __construct()
    {
        $this->productos = new ArrayCollection();
        $this->subCategorias = new ArrayCollection();
        $this->subSubCategorias = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    /**
     * @return Collection|Producto[]
     */
    public function getProductos(): Collection
    {
        return $this->productos;
    }

    public function addProducto(Producto $producto): self
    {
        if (!$this->productos->contains($producto)) {
            $this->productos[] = $producto;
            $producto->setCategoria($this);
        }

        return $this;
    }

    public function removeProducto(Producto $producto): self
    {
        if ($this->productos->contains($producto)) {
            $this->productos->removeElement($producto);
            // set the owning side to null (unless already changed)
            if ($producto->getCategoria() === $this) {
                $producto->setCategoria(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|SubCategoria[]
     */
    public function getSubCategorias(): Collection
    {
        return $this->subCategorias;
    }

    public function addSubCategoria(SubCategoria $subCategoria): self
    {
        if (!$this->subCategorias->contains($subCategoria)) {
            $this->subCategorias[] = $subCategoria;
            $subCategoria->setCategoria($this);
        }

        return $this;
    }

    public function removeSubCategoria(SubCategoria $subCategoria): self
    {
        if ($this->subCategorias->contains($subCategoria)) {
            $this->subCategorias->removeElement($subCategoria);
            // set the owning side to null (unless already changed)
            if ($subCategoria->getCategoria() === $this) {
                $subCategoria->setCategoria(null);
            }
        }

        return $this;
    }
}
