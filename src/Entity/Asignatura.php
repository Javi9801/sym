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
     * @ORM\ManyToMany(targetEntity=Alumno::class, mappedBy="asignaturas")
     */


    private $alumnos;

    public function __construct()
    {
        $this->alumno = new ArrayCollection();
    }



   /**
     * @return Collection|Alumno[]
     */
    public function getAlumnos(): Collection
    {
        return $this->alumnos;
    }

    public function addAlumno(Alumno $alumnos): self
    {
        if (!$this->alumnos->contains($alumnos)) {
            $this->alumnos[] = $alumnos;
            $alumnos->addAsignatura($this);
        }

        return $this;
    }

    public function removeAlumno(Alumno $alumnos): self
    {
        if ($this->alumno->removeElement($alumnos)) {
            // set the owning side to null (unless already changed)

            $alumnos->removeAsignatura($this);

        }

        return $this;
    }

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


}
