<?php

namespace App\Entity;

use App\Repository\AlumnoRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AlumnoRepository::class)
 */
class Alumno
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
    private $nombre;

    /**
     * @ORM\ManyToOne(targetEntity=AlumnoAsignatura::class, inversedBy="alumno")
     * @ORM\JoinColumn(nullable=false)
     */
    private $alumnoAsignatura;


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
