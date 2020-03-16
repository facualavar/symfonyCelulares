<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductoRepository")
 */
class Producto
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $nombre;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $descripcion;

    /**
     * @ORM\Column(type="boolean")
     */
    private $usado;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $oferta;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $novedad;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $destacado;

    /**
     * @ORM\Column(type="integer")
     */
    private $alto;

    /**
     * @ORM\Column(type="integer")
     */
    private $ancho;

    /**
     * @ORM\Column(type="integer")
     */
    private $largo;

    /**
     * @ORM\Column(type="integer")
     */
    private $peso;

    /**
     * @ORM\Column(type="boolean")
     */
    private $habilitado;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $descuento;

    /**
     * @ORM\Column(type="integer")
     */
    private $precio;

    /**
     * @ORM\Column(type="integer")
     */
    private $stock;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Categoria", inversedBy="productos")
     */
    private $categoria;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\SubCategoria", inversedBy="productos")
     */
    private $subCategoria;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\SubSubCategoria", inversedBy="productos")
     */
    private $subSubCategoria;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Pais", inversedBy="productos")
     */
    private $pais;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Marca", inversedBy="productos")
     */
    private $marca;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Genero", inversedBy="productos")
     */
    private $genero;

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

    public function getDescripcion(): ?string
    {
        return $this->descripcion;
    }

    public function setDescripcion(string $descripcion): self
    {
        $this->descripcion = $descripcion;

        return $this;
    }

    public function getUsado(): ?bool
    {
        return $this->usado;
    }

    public function setUsado(bool $usado): self
    {
        $this->usado = $usado;

        return $this;
    }

    public function getOferta(): ?bool
    {
        return $this->oferta;
    }

    public function setOferta(?bool $oferta): self
    {
        $this->oferta = $oferta;

        return $this;
    }

    public function getNovedad(): ?bool
    {
        return $this->novedad;
    }

    public function setNovedad(?bool $novedad): self
    {
        $this->novedad = $novedad;

        return $this;
    }

    public function getDestacado(): ?bool
    {
        return $this->destacado;
    }

    public function setDestacado(?bool $destacado): self
    {
        $this->destacado = $destacado;

        return $this;
    }

    public function getAlto(): ?int
    {
        return $this->alto;
    }

    public function setAlto(int $alto): self
    {
        $this->alto = $alto;

        return $this;
    }

    public function getAncho(): ?int
    {
        return $this->ancho;
    }

    public function setAncho(int $ancho): self
    {
        $this->ancho = $ancho;

        return $this;
    }

    public function getLargo(): ?int
    {
        return $this->largo;
    }

    public function setLargo(int $largo): self
    {
        $this->largo = $largo;

        return $this;
    }

    public function getPeso(): ?int
    {
        return $this->peso;
    }

    public function setPeso(int $peso): self
    {
        $this->peso = $peso;

        return $this;
    }

    public function getHabilitado(): ?bool
    {
        return $this->habilitado;
    }

    public function setHabilitado(bool $habilitado): self
    {
        $this->habilitado = $habilitado;

        return $this;
    }

    public function getDescuento(): ?int
    {
        return $this->descuento;
    }

    public function setDescuento(?int $descuento): self
    {
        $this->descuento = $descuento;

        return $this;
    }

    public function getPrecio(): ?int
    {
        return $this->precio;
    }

    public function setPrecio(int $precio): self
    {
        $this->precio = $precio;

        return $this;
    }

    public function getStock(): ?int
    {
        return $this->stock;
    }

    public function setStock(int $stock): self
    {
        $this->stock = $stock;

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

    public function getSubCategoria(): ?SubCategoria
    {
        return $this->subCategoria;
    }

    public function setSubCategoria(?SubCategoria $subCategoria): self
    {
        $this->subCategoria = $subCategoria;

        return $this;
    }

    public function getSubSubCategoria(): ?SubSubCategoria
    {
        return $this->subSubCategoria;
    }

    public function setSubSubCategoria(?SubSubCategoria $subSubCategoria): self
    {
        $this->subSubCategoria = $subSubCategoria;

        return $this;
    }

    public function getPais(): ?Pais
    {
        return $this->pais;
    }

    public function setPais(?Pais $pais): self
    {
        $this->pais = $pais;

        return $this;
    }

    public function getMarca(): ?Marca
    {
        return $this->marca;
    }

    public function setMarca(?Marca $marca): self
    {
        $this->marca = $marca;

        return $this;
    }

    public function getGenero(): ?Genero
    {
        return $this->genero;
    }

    public function setGenero(?Genero $genero): self
    {
        $this->genero = $genero;

        return $this;
    }
}
