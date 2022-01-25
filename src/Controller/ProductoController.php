<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Producto;
use App\Entity\Category;
use Symfony\Component\Routing\Annotation\Route;

class ProductoController extends AbstractController
{
    /**
     * @Route("/producto/crearProducto", name="producto")
     */
    public function creaProducto(ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();
        $producto = new Producto();

        $category = $doctrine->getRepository(Category::class)->find(1);

        if (!$category) {
            throw $this->createNotFoundException(
                'No category found for id '.$id
            );
        }

        $producto->setName('Raton');
        $producto->setPrecio(1457);
        $producto->setCategory($category);

        $entityManager->persist($producto);
        $entityManager->flush();

        return new Response('Nuevo producto creado');

    }

    /**
     * @Route("/producto/mostrarProducto/{id}", methods={"GET","HEAD"}), name="product_show")
     */
    public function mostrarProducto(ManagerRegistry $doctrine, int $id): Response
    {
        $producto = $doctrine->getRepository(Producto::class)->findOneBy(['name' => 'Keyboard']);

        if (!$producto) {
            throw $this->createNotFoundException(
                'Producto '.$id.' no encontrado'
            );
        }

        // or render a template
        // in the template, print things with {{ product.name }}

        return $this->render('producto/mostrarProducto.html.twig', ['producto' => $producto->getName()]);
    }


     /**
     * @Route("/producto/mostrarProductos/{idCategoria}", methods={"GET","HEAD"}), name="product_show")
     */
    public function mostrarProductos(ManagerRegistry $doctrine, int $idCategoria): Response
    {
        $categoria = $doctrine->getRepository(Category::class)->find($idCategoria);

        if (!$categoria) {
            throw $this->createNotFoundException(
                'Productos con categoria '.$idCategoria.' no encontrado'
            );
        } else {

        $productos = $categoria->getProductos();


        // or render a template
        // in the template, print things with {{ product.name }}

            return $this->render('producto/mostrarProductos.html.twig', ['productos' => $productos]);
        }
    }
}
