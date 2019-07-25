<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ClienteRepository")
 */
class Cliente
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
    private $Nombre;

    /**
     * @ORM\Column(type="string", length=15)
     */
    private $telefono;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $rut;

    /**
     * @ORM\Column(type="string", length=1, nullable=true)
     */
    private $dv;

    /**
     * @ORM\OneToOne(targetEntity="App\Entity\Usuario", cascade={"persist", "remove"})
     */
    private $usuario;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Direccion", mappedBy="cliente", orphanRemoval=true, cascade={"persist", "remove"})
     */
    private $direcciones;

    public function __construct()
    {
        $this->direcciones = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->Nombre;
    }

    public function setNombre(string $Nombre): self
    {
        $this->Nombre = $Nombre;

        return $this;
    }

    public function getTelefono(): ?string
    {
        return $this->telefono;
    }

    public function setTelefono(string $telefono): self
    {
        $this->telefono = $telefono;

        return $this;
    }

    public function getRut(): ?int
    {
        return $this->rut;
    }

    public function setRut(?int $rut): self
    {
        $this->rut = $rut;

        return $this;
    }

    public function getDv(): ?string
    {
        return $this->dv;
    }

    public function setDv(?string $dv): self
    {
        $this->dv = $dv;

        return $this;
    }

    public function getUsuario(): ?Usuario
    {
        return $this->usuario;
    }

    public function setUsuario(?Usuario $usuario): self
    {
        $this->usuario = $usuario;

        return $this;
    }

    /**
     * @return Collection|Direccion[]
     */
    public function getDirecciones(): Collection
    {
        return $this->direcciones;
    }

    public function addDireccion(Direccion $direccion): self
    {
        if (!$this->direcciones->contains($direccion)) {
            $this->direcciones[] = $direccion;
            $direccion->setCliente($this);
        }

        return $this;
    }

    public function removeDireccion(Direccion $direccion): self
    {
        if ($this->direcciones->contains($direccion)) {
            $this->direcciones->removeElement($direccion);
            // set the owning side to null (unless already changed)
            if ($direccion->getCliente() === $this) {
                $direccion->setCliente(null);
            }
        }

        return $this;
    }
}
