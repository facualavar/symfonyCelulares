<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SubCategoriaRepository")
 */
class SubCategoria
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Categoria", inversedBy="subCategorias")
     */
    private $categoria;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\SubSubCategoria", mappedBy="subCategoria")
     */
    private $subSubCategorias;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Producto", mappedBy="subCategoria")
     */
    private $productos;

    public function __construct()
    {
        $this->subSubCategorias = new ArrayCollection();
        $this->productos = new ArrayCollection();
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

    public function getCategoria(): ?Categoria
    {
        return $this->categoria;
    }

    public function setCategoria(?Categoria $categoria): self
    {
        $this->categoria = $categoria;

        return $this;
    }

    /**
     * @return Collection|SubSubcategoria[]
     */
    public function getSubSubCategorias(): Collection
    {
        return $this->subSubCategorias;
    }

    public function addSubSubCategoria(SubSubcategoria $subSubCategoria): self
    {
        if (!$this->subSubCategorias->contains($subSubCategoria)) {
            $this->subSubCategorias[] = $subSubCategoria;
            $subSubCategoria->setSubCategoria($this);
        }

        return $this;
    }

    public function removeSubSubCategoria(SubSubcategoria $subSubCategoria): self
    {
        if ($this->subSubCategorias->contains($subSubCategoria)) {
            $this->subSubCategorias->removeElement($subSubCategoria);
            // set the owning side to null (unless already changed)
            if ($subSubCategoria->getSubCategoria() === $this) {
                $subSubCategoria->setSubCategoria(null);
            }
        }

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
            $producto->setSubCategoria($this);
        }

        return $this;
    }

    public function removeProducto(Producto $producto): self
    {
        if ($this->productos->contains($producto)) {
            $this->productos->removeElement($producto);
            // set the owning side to null (unless already changed)
            if ($producto->getSubCategoria() === $this) {
                $producto->setSubCategoria(null);
            }
        }

        return $this;
    }
}
