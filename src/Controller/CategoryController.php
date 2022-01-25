<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Producto;
use App\Entity\Category;
use App\Controller\ProductoRepository;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    /**
     * @Route("/category/crearCategory", name="category")
     */
    public function creaCategory(ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();
        $category = new Category();

        $category->setName('Electronica');

        $entityManager->persist($category);
        $entityManager->flush();

        return new Response('Nueva categoria creada');

    }

    /**
     * @Route("/categoria/mostrarCategoria/{id}", methods={"GET","HEAD"}), name="category_show")
     */
    public function mostrarCategoria(ManagerRegistry $doctrine, int $id): Response
    {
        $producto = $doctrine->getRepository(Producto::class)->find($id);

        if (!$producto) {
            throw $this->createNotFoundException(
                'Producto '.$id.' no encontrado'
            );
        } else {
            $categoria = $producto->getCategory();

        // or render a template
        // in the template, print things with {{ product.name }}

            return $this->render('categoria/mostrarCategoria.html.twig', ['categoria' => $categoria, 'producto'=> $producto]);
        }
    }

}
