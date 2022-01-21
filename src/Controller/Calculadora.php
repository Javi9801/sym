<?php
// src/Controller/LuckyController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class Calculadora extends AbstractController
{
    /**
    * @Route("/calculadora/suma/{n1}/{n2}", methods={"GET","HEAD"}),requirements={"n1"="\d+"}{"n2"="\d+"})
    */
    public function suma(int $n1, int $n2): Response
    {
        $operacion = "suma";
        $resultado = $n1+$n2;
        // return new Response('<html><body>La suma de los dos numeros es : '.$suma.'</body></html>'
        
        // );

        return $this->render('calculadora/calculadora.html.twig', [
            'operacion' => $operacion,
            'resultado' => $resultado,
            'n1' => $n1,
            'n2' => $n2,
        ]);
    }

    /**
    * @Route("/calculadora/resta/{n1}/{n2}", methods={"GET","HEAD"}), requirements={"n1"="\d+"}{"n2"="\d+"})
    */
    public function resta(int $n1, int $n2): Response
    {
        $operacion = "resta";
        $resultado = $n1-$n2;
        // return new Response('<html><body>La resta de los dos numeros es : '.$resta.'</body></html>'
        
        // );

        return $this->render('calculadora/calculadora.html.twig', [
            'operacion' => $operacion,
            'resultado' => $resultado,
            'n1' => $n1,
            'n2' => $n2,
        ]);
    }

    /**
    * @Route("/calculadora/producto/{n1}/{n2}", methods={"GET","HEAD"}) ,"requirements={"n1"="\d+"}{"n2"="\d+"})
    */
    public function producto(int $n1, int $n2): Response
    {
        $operacion = " producto";
        $resultado = $n1*$n2;
        // return new Response('<html><body>El producto de los dos numeros es : '.$producto.'</body></html>'
        
        // );
        return $this->render('calculadora/calculadora.html.twig', [
            'operacion' => $operacion,
            'resultado' => $resultado,
            'n1' => $n1,
            'n2' => $n2,
        ]);
    }

    /**
    * @Route("/calculadora/division/{n1}/{n2}", methods={"GET","HEAD"})", requirements={"n1"="\d+"}{"n2"="\d+"})
    */
    public function division(int $n1, int $n2): Response
    {
        $operacion = "division";
        $resultado = $n1/$n2;
        // return new Response('<html><body>La division de los dos numeros es : '.$division.'</body></html>'
        
        // );

        return $this->render('calculadora/calculadora.html.twig', [
            'operacion' => $operacion,
            'resultado' => $resultado,
            'n1' => $n1,
            'n2' => $n2,
        ]);
    }
}