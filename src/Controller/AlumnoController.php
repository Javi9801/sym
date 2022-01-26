<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Alumno;
use App\Entity\Asignatura;
use Symfony\Component\Routing\Annotation\Route;

class AlumnoController extends AbstractController
{
    /**
     * @Route("/alumno/crearAlumno", name="alumno")
     */
    public function creaAlumno(ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();
        $alumno = new Alumno();

        $alumno->setNombre('Juan');

        $entityManager->persist($alumno);
        $entityManager->flush();

        return new Response('Nuevo alumno creado');

    }

    /**
     * @Route("/alumno/mostrarAlumnos", methods={"GET","HEAD"}), name="alumnos_show")
     */
    public function mostrarAlumnos(ManagerRegistry $doctrine): Response
    {
        $alumnos = $doctrine->getRepository(Alumno::class)->findAll();

        if (!$alumnos) {
            throw $this->createNotFoundException(
                'No hay alumnos'
            );
        }

        // or render a template
        // in the template, print things with {{ product.name }}

        return $this->render('alumno/mostrarAlumnos.html.twig', ['alumnos' => $alumnos]);
    }


     /**
     * @Route("/alumno/mostrarAlumno/{id}", methods={"GET","HEAD"}), name="alumnos_show")
     */
    public function mostrarAlumno(ManagerRegistry $doctrine, int $id): Response
    {
        $alumno = $doctrine->getRepository(Alumno::class)->find($id);

        if (!$alumno) {
            throw $this->createNotFoundException(
                'No hay alumnos'
            );
        }

        // or render a template
        // in the template, print things with {{ product.name }}

        return $this->render('alumno/mostrarAlumno.html.twig', ['alumno' => $alumno]);
    }


     /**
     * @Route("/asignar/asignarAsignatura/{idAlumno}/{idAsignatura}", methods={"GET","HEAD"}), name="asignar_asignaturas")
     */
    public function asignarAsignatura(ManagerRegistry $doctrine, int $idAlumno, int $idAsignatura): Response
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

                $alumno->addAsignatura($asignatura);

                $entityManager->persist($alumno);
                $entityManager->flush();

        // or render a template
        // in the template, print things with {{ product.name }}

            return new Response("Asignatura añadida");
            }
        }
    }
}
