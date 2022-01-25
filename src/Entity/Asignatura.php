<?php

namespace App\Entity;

use App\Repository\AsignaturaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AsignaturaRepository::class)
 */
class Asignatura
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $descripcion;

    /**
     * @ORM\ManyToOne(targetEntity=AlumnoAsignatura::class, inversedBy="Asignatura")
     * @ORM\JoinColumn(nullable=false)
     */
    private $alumnoAsignatura;


    public function getId(): ?int
    {
        return $this->id;
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

    public function getAlumnoAsignatura(): ?AlumnoAsignatura
    {
        return $this->alumnoAsignatura;
    }

    public function setAlumnoAsignatura(?AlumnoAsignatura $alumnoAsignatura): self
    {
        $this->alumnoAsignatura = $alumnoAsignatura;

        return $this;
    }


}
