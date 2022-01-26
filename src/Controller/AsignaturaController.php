<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Alumno;
use App\Entity\Asignatura;
use Symfony\Component\Routing\Annotation\Route;

class AsignaturaController extends AbstractController
{
    /**
     * @Route("/asignatura/crearAsignatura", name="asignatura")
     */
    public function creaAsignatura(ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();
        $asignatura = new Asignatura();

        $asignatura->setDescripcion('Lengua');

        $entityManager->persist($asignatura);
        $entityManager->flush();

        return new Response('Nueva asignatura creado');

    }

    /**
     * @Route("/asignar/asignarAlumno/{idAlumno}/{idAsignatura}", methods={"GET","HEAD"}), name="asignar_asignaturas")
     */
    public function asignarAlumno(ManagerRegistry $doctrine, int $idAlumno, int $idAsignatura): Response
    {
        $entityManager = $doctrine->getManager();
        $alumno = $doctrine->getRepository(Alumno::class)->find($idAlumno);
        $asignatura = $doctrine->getRepository(Asignatura::class)->find($idAsignatura);

        if (!$alumno) {
            throw $this->createNotFoundException(
                'Alumno '.$idAlumno.' no encontrado'
            );
        } else {
            if (!$asignatura) {
                throw $this->createNotFoundException(
                    'Asignatura '.$idAsignatura.' no encontrada'
                );
            } else {

                $asignatura->addAlumno($alumno);

                $entityManager->persist($asignatura);
                $entityManager->flush();

        // or render a template
        // in the template, print things with {{ product.name }}

            return new Response("Alumno añadido");
            }
        }
    }


}
