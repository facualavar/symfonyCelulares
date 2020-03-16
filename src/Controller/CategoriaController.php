<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Categoria;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Serializer;


class CategoriaController extends AbstractController
{
    /**
     * @Route("/categoria", name="categorias")
     */
    public function index()
    {
        $catManager = $this->getDoctrine()->getManager();
        $categorias = $catManager->getRepository(Categoria::class)->findAll();

        $response = new Response();
        $encoders = array(new JsonEncoder());
        
        //Serialize Manejo de Referencias Circulares
        $defaultContext = [
            AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER => function ($object, $format, $context) {
                return $object->getNombre();
            },
        ];
        $normalizers = array((new ObjectNormalizer(null, null, null, null, null, null, $defaultContext))->setIgnoredAttributes(
            [
                "__initializer__", 
                "__cloner__",
                "__isInitialized__",
                "productos",
                //"subCategorias",
                //"subSubCategorias"
            ]
        ));
        //

        $serializer = new Serializer($normalizers, $encoders);

        $response->setContent(json_encode(array(
        'categoria' => $serializer->serialize($categorias, 'json'),
        )));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    /**
     * @Route("/categoria/get/{id}", name="categoria")
     */
    public function categoria($id)
    {
        $catManager = $this->getDoctrine()->getManager();
        $categoria = $catManager->getRepository(Categoria::class)->find($id);
        if (!$categoria){
            throw $this->createNotFoundException('error de sistema');
        }
        
        $response = new Response();
        $encoders = array(new JsonEncoder());
        
        //Serialize Manejo de Referencias Circulares
        $defaultContext = [
            AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER => function ($object, $format, $context) {
                return $object->getNombre();
            },
        ];
        $normalizers = array((new ObjectNormalizer(null, null, null, null, null, null, $defaultContext))->setIgnoredAttributes(
            [
                "__initializer__", 
                "__cloner__",
                "__isInitialized__",
                "productos",
                //"subCategorias",
                //"subSubCategorias"
            ]
        ));
        //

        $serializer = new Serializer($normalizers, $encoders);

        $response->setContent(json_encode(array(
        'categoria' => $serializer->serialize($categoria, 'json'),
        )));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    /**
     * @Route("/categoria/edit/{id}", name="editarCategoria")
     */
    public function update($id)
    {
        $catManager = $this->getDoctrine()->getManager();
        $categoria = $catManager->getRepository(Categoria::class)->find($id);
        if (!$categoria){
            throw $this->createNotFoundException('error de sistema');
        }
        
        $response = new Response();
        $encoders = array(new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());
        $serializer = new Serializer($normalizers, $encoders);

        $response->setContent(json_encode(array(
        'categoria' => $serializer->serialize($categoria, 'json'),
        )));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    /**
     * @Route("categoria/new", name="nuevaCategoria")
     */
    public function new()
    {
        $catManager = $this->getDoctrine()->getManager();
        $categoria = $catManager->getRepository(Categoria::class)->findAll();
        
        $response = new Response();
        $encoders = array(new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());
        $serializer = new Serializer($normalizers, $encoders);

        $response->setContent(json_encode(array(
        'categoria' => $serializer->serialize($categoria, 'json'),
        )));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
}
