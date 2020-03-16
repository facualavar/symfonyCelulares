<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Categoria;
use App\Entity\SubCategoria;
use App\Entity\SubSubCategoria;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Serializer;

class SubCategoriaController extends AbstractController
{
    /**
     * @Route("/subcategoria", name="subcategorias")
     */
    public function index()
    {
        $catManager = $this->getDoctrine()->getManager();
        $subcategorias = $catManager->getRepository(SubCategoria::class)->findAll();

        $response = new Response();
        $encoders = array(new JsonEncoder());
        
         //Serialize: Manejo de Referencias Circulares, personalizo el Normalizer
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
                "subCategorias",
                "subSubCategorias"
            ]
        ));
        //

        $serializer = new Serializer($normalizers, $encoders);

        $response->setContent(json_encode(array(
        'subcategoria' => $serializer->serialize($subcategorias, 'json'),
        )));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    /**
     * @Route("/subcategoria/get/{id}", name="subcategoria")
     */
    public function subcategoria($id)
    {
        $catManager = $this->getDoctrine()->getManager();

        $subcategoria = $catManager->getRepository(SubCategoria::class)->find($id);
        if (!$subcategoria){
            throw $this->createNotFoundException('error de sistema');
        }

        //Response, Normalizer, Serializer
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
                "subCategorias",
                "subSubCategorias"
            ]
        ));
        //

        $serializer = new Serializer($normalizers, $encoders);
        $response->setContent(json_encode(array(
        'subcategoria' => $serializer->serialize($subcategoria, 'json'),
        )));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    /**
     * @Route("/subcategoria/edit/{id}", name="editarSubCategoria")
     */
    public function update($id)
    {
        $catManager = $this->getDoctrine()->getManager();
        $subcategoria = $catManager->getRepository(SubCategoria::class)->find($id);
        if (!$subcategoria){
            throw $this->createNotFoundException('error de sistema');
        }
        
        $response = new Response();
        $encoders = array(new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());
        $serializer = new Serializer($normalizers, $encoders);

        $response->setContent(json_encode(array(
        'subcategoria' => $serializer->serialize($subcategoria, 'json'),
        )));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    /**
     * @Route("/subcategoria/new", name="nuevaSubCategoria")
     */
    public function new()
    {
        $catManager = $this->getDoctrine()->getManager();
        $subcategoria = $catManager->getRepository(SubCategoria::class)->findAll();
        
        $response = new Response();
        $encoders = array(new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());
        $serializer = new Serializer($normalizers, $encoders);

        $response->setContent(json_encode(array(
        'subcategoria' => $serializer->serialize($subcategoria, 'json'),
        )));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
}
