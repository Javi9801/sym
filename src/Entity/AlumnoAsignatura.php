<?php

namespace App\Entity;

use App\Repository\AlumnoAsignaturaRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=AlumnoAsignaturaRepository::class)
 */
class AlumnoAsignatura
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\OneToMany(targetEntity=Alumno::class, mappedBy="alumnoAsignatura")
     */
    private $alumno;

    /**
     * @ORM\OneToMany(targetEntity=Asignatura::class, mappedBy="alumnoAsignatura")
     */
    private $Asignatura;

    public function __construct()
    {
        $this->alumno = new ArrayCollection();
        $this->Asignatura = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return Collection|Alumno[]
     */
    public function getAlumno(): Collection
    {
        return $this->alumno;
    }

    public function addAlumno(Alumno $alumno): self
    {
        if (!$this->alumno->contains($alumno)) {
            $this->alumno[] = $alumno;
            $alumno->setAlumnoAsignatura($this);
        }

        return $this;
    }

    public function removeAlumno(Alumno $alumno): self
    {
        if ($this->alumno->removeElement($alumno)) {
            // set the owning side to null (unless already changed)
            if ($alumno->getAlumnoAsignatura() === $this) {
                $alumno->setAlumnoAsignatura(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Asignatura[]
     */
    public function getAsignatura(): Collection
    {
        return $this->Asignatura;
    }

    public function addAsignatura(Asignatura $asignatura): self
    {
        if (!$this->Asignatura->contains($asignatura)) {
            $this->Asignatura[] = $asignatura;
            $asignatura->setAlumnoAsignatura($this);
        }

        return $this;
    }

    public function removeAsignatura(Asignatura $asignatura): self
    {
        if ($this->Asignatura->removeElement($asignatura)) {
            // set the owning side to null (unless already changed)
            if ($asignatura->getAlumnoAsignatura() === $this) {
                $asignatura->setAlumnoAsignatura(null);
            }
        }

        return $this;
    }
}
