<?php

namespace App\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

/**
 * Proveedores
 *
 * @ORM\Table(name="proveedores")
 * @ORM\Entity
 */
class Proveedores
{
    /**
     * @var int
     *
     * @ORM\Column(name="id_proveedor", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idProveedor;

    /**
     * @var string
     *
     * @ORM\Column(name="nombre", type="string", length=255, nullable=false)
     */
    private $nombre;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="numero_telefono", type="string", length=20, nullable=false)
     */
    private $numeroTelefono;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo", type="string", length=12, nullable=false)
     */
    private $tipo;

    /**
     * @var bool
     *
     * @ORM\Column(name="activo", type="boolean", nullable=false)
     */
    private $activo;

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="fecha_introduccion", type="date", nullable=true, options={"default"="NULL"})
     */
    private $fechaIntroduccion = 'NULL';

    /**
     * @var \DateTime|null
     *
     * @ORM\Column(name="fecha_actualizacion", type="date", nullable=true, options={"default"="NULL"})
     */
    private $fechaActualizacion = 'NULL';

    public function getIdProveedor(): ?int
    {
        return $this->idProveedor;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): static
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getNumeroTelefono(): ?string
    {
        return $this->numeroTelefono;
    }

    public function setNumeroTelefono(string $numeroTelefono): static
    {
        $this->numeroTelefono = $numeroTelefono;

        return $this;
    }

    public function getTipo(): ?string
    {
        return $this->tipo;
    }

    public function setTipo(string $tipo): static
    {
        $this->tipo = $tipo;

        return $this;
    }

    public function isActivo(): ?bool
    {
        return $this->activo;
    }

    public function setActivo(bool $activo): static
    {
        $this->activo = $activo;

        return $this;
    }

    public function getFechaIntroduccion(): ?\DateTimeInterface
    {
        return $this->fechaIntroduccion;
    }

    public function setFechaIntroduccion(?\DateTimeInterface $fechaIntroduccion): static
    {
        $this->fechaIntroduccion = $fechaIntroduccion;

        return $this;
    }

    public function getFechaActualizacion(): ?\DateTimeInterface
    {
        return $this->fechaActualizacion;
    }

    public function setFechaActualizacion(?\DateTimeInterface $fechaActualizacion): static
    {
        $this->fechaActualizacion = $fechaActualizacion;

        return $this;
    }


}
