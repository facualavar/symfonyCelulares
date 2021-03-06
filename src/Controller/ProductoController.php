<?php

namespace App\Controller;

use App\Entity\Producto;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Serializer;

class ProductoController extends AbstractController
{

    // src/Controller/Producto.php

    /**
    * @Route("/producto", name="producto_ver")
    */

    public function index()
    {            
        $prodManager = $this->getDoctrine()->getManager();
        $productos = $prodManager->getRepository(Producto::class)->findAll();

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
        'productos' => $serializer->serialize($productos, 'json'),
        )));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }


    /**
    * @Route("/producto/get/{id}", name="producto_buscar")
    */

    public function producto($id)
    {
        $prodManager = $this->getDoctrine()->getManager();
        $producto = $prodManager->getRepository(Producto::class)->find($id);
        if (!$producto){
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
                "subCategorias",
                "subSubCategorias"
            ]
        ));
        //
        
        $serializer = new Serializer($normalizers, $encoders);

        $response->setContent(json_encode(array(
        'producto' => $serializer->serialize($producto, 'json'),
        )));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }


    /**
    * @Route("/producto/new", name="producto_nuevo")
    */

    public function new(Request $producto){

        //tranformamos el archivo Json
        $data = json_decode($producto->getContent(), true);
        $producto->request->replace($data);

        //creamos una Producto
        $prod = new Producto();
        $prod->setNombre($producto->request->get('nombre'));
        $prod->setDescripcion($producto->request->get('descripcion'));
        $prod->setCategoria($producto->request->get('categoria'));
        $prod->setMarca($producto->request->get('marca'));
        $prod->setCaracteristicas($producto->request->get('caracteristicas'));
        $prod->setImg($producto->request->get('img'));
        $prod->setImg2($producto->request->get('img2'));
        $prod->setImg3($producto->request->get('img3'));
        $prod->setPrecio($producto->request->get('precio'));
        $prod->setStock($producto->request->get('stock'));


        //guardamos en la bd        
        $prodManager = $this->getDoctrine()->getManager();
        $prodManager->persist($prod);
        $prodManager->flush();
        
        $result['status'] = 'ok';
        return new Response(json_encode($result), 200);
    }


    /**
    * @Route("/producto/edit/{id}", name="producto_edit")
    */

    public function update($id, Request $producto){

        //tranformamos el archivo Json
        $data = json_decode($producto->getContent(), true);
        $producto->request->replace($data);


        $prodManager = $this->getDoctrine()->getManager();

        //creamos una Producto
        $prod = $prodManager -> getRepository(Producto::class) -> find($id);
        $prod->setNombre($producto->request->get('nombre'));
        $prod->setDescripcion($producto->request->get('descripcion'));
        $prod->setCategoria($producto->request->get('categoria'));
        $prod->setMarca($producto->request->get('marca'));
        $prod->setCaracteristicas($producto->request->get('caracteristicas'));
        $prod->setImg($producto->request->get('img'));
        $prod->setImg2($producto->request->get('img2'));
        $prod->setImg3($producto->request->get('img3'));
        $prod->setPrecio($producto->request->get('precio'));
        $prod->setStock($producto->request->get('stock'));

        //guardamos en la bd        
        
        $prodManager->persist($prod);
        $prodManager->flush();
        
        $result['status'] = 'ok';
        return new Response(json_encode($result), 200);
    }

    
     /**
     * @Route("/producto/delete/{id}", name="producto_delete")
     */
    public function borrar($id)
    {
        $prodManager = $this->getDoctrine()->getManager();
        $producto = $prodManager->getRepository(Producto::class)->find($id);
        if (!$producto){
            throw $this->createNotFoundException('id incorrecta');
        }
        $prodManager->remove($producto);
        $prodManager->flush();
        $result['status'] = 'ok';
        return new Response(json_encode($result), 200);
    }
}
