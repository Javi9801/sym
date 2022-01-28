<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Persistence\ManagerRegistry;
use App\Entity\Producto;
use App\Entity\Category;
use App\Form\Type\ProductoType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

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

        $producto->setName('Monitor');
        $producto->setPrecio(500);
        $producto->setCategory($category);
        $producto->setDescripcion("Viene con los cables");


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
     * @Route("/producto/mostrarProductos", methods={"GET","HEAD"}), name="productos")
     */
    public function mostrarProductos(ManagerRegistry $doctrine): Response
    {
        $categoria = $doctrine->getRepository(Category::class)->find(1);

        $productos = $categoria->getProductos();


        // or render a template
        // in the template, print things with {{ product.name }}

            return $this->render('producto/mostrarProductos.html.twig', ['productos' => $productos]);

    }



 /**
     * @Route("/producto/formulario_producto", name="form_producto")
     */
    public function new(ManagerRegistry $doctrine, Request $request): Response
    {
        // just set up a fresh $task object (remove the example data)
        $producto = new Producto();
        $entityManager = $doctrine->getManager();
        $category = $doctrine->getRepository(Category::class)->find(1);

        $form = $this->createForm(ProductoType::class, $producto);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $producto = $form->getData();
            $producto->setCategory($category);
            $entityManager->persist($producto);
            $entityManager->flush();



            // ... perform some action, such as saving the task to the database

            return $this->redirectToRoute('app_producto_mostrarproductos');
        }

        return $this->renderForm('producto/formulario_producto.html.twig', [
            'form' => $form,
        ]);
    }

    /**
     * @Route("/producto/borrar/{id}", name="borrar")
     */
    public function borrar(ManagerRegistry $doctrine, int $id): Response
    {
        $entityManager = $doctrine->getManager();
        $repository = $doctrine->getRepository(Producto::class);
        $producto = $repository->find($id);
        $entityManager->remove($producto);
        $entityManager->flush();

        return $this->redirectToRoute('app_producto_mostrarproductos');
    }
}
