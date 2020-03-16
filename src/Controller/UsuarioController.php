<?php

namespace App\Controller;

use App\Entity\Usuario;
use Doctrine\ORM\EntityManagerInterface;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
 * @Route("/usuario")
 */
class UsuarioController extends AbstractController
{
    /**
     * @Route("/usuario/ingreso", name="usuario_authenticate")
     */
    public function authenticate(Request $request)
    {

        $data = json_decode($request->getContent(), true);
        $request->request->replace($data);
        //creamos un usuario
        $username = $request->request->get('usuario');
        $userpassword = $request->request->get('password');

        $criteria = array('usuario' => $username, 'password' => $userpassword);
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository(Usuario::class)->findBy($criteria);
		
        if($user != null){
            $resultUsuario = $user[0];
        }else{
            //retorno un usuario sin datos
            $resultUsuario = new Usuario();
        }
        //genero la respuesta hacia el cliente
        $response = new Response();
        $encoders = array(new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());
        $serializer = new Serializer($normalizers, $encoders);
        $response->setContent(json_encode(array(
        'usuario' => $serializer->serialize($resultUsuario, 'json'),
        )));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    /**
    * @Route("/", name="usuario_index", methods={"GET"})
    */

    public function index()
    {            
        $usuManager = $this->getDoctrine()->getManager();
        $usuarios = $usuManager->getRepository(Usuario::class)->findAll();

        $response = new Response();
        $encoders = array(new JsonEncoder());
        
        //Serialize Manejo de Referencias Circulares
        $defaultContext = [
            AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER => function ($object, $format, $context) {
                return $object->getNombres();
            },
        ];
        $normalizers = array((new ObjectNormalizer(null, null, null, null, null, null, $defaultContext))->setIgnoredAttributes(
            [
                "__initializer__", 
                "__cloner__",
                "__isInitialized__",
                "usuarios"
            ]
        ));
        //

        $serializer = new Serializer($normalizers, $encoders);

        $response->setContent(json_encode(array(
        'usuarios' => $serializer->serialize($usuarios, 'json'),
        )));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    /**
    * @Route("/{id}", name="un_usuario", methods={"GET"})
    */

    public function usuario($id)
    {   
        $usuManager = $this->getDoctrine()->getManager();
        $usuario = $usuManager->getRepository(Usuario::class)->find($id);
        if (!$usuario){
            throw $this->createNotFoundException('id incorrecta');
        }

        $response = new Response();
        $encoders = array(new JsonEncoder());
        
        //Serialize Manejo de Referencias Circulares
        $defaultContext = [
            AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER => function ($object, $format, $context) {
                return $object->getNombres();
            },
        ];
        $normalizers = array((new ObjectNormalizer(null, null, null, null, null, null, $defaultContext))->setIgnoredAttributes(
            [
                "__initializer__", 
                "__cloner__",
                "__isInitialized__",
            ]
        ));
        //

        $serializer = new Serializer($normalizers, $encoders);

        $response->setContent(json_encode(array(
        'usuarios' => $serializer->serialize($usuarios, 'json'),
        )));
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }


    /**
    * @Route("/new", name="usuario_nuevo")
    */

    public function nuevo(Request $usuario){

        //tranformamos el archivo Json
        $data = json_decode($usuario->getContent(), true);
        $usuario->request->replace($data);

        //creamos una usuario
        $usu = new Usuario();
        $usu->setNombres($usuario->request->get('nombres'));
        $usu->setApellido($usuario->request->get('apellido'));
        $usu->setUsuario($usuario->request->get('usuario'));
        $usu->setPassword($usuario->request->get('password'));
        $usu->setEmail($usuario->request->get('email'));
        $usu->setPerfil($usuario->request->get('perfil'));

        //guardamos en la bd        
        $usuManager = $this->getDoctrine()->getManager();
        $usuManager->persist($usu);
        $usuManager->flush();
        
        $result['status'] = 'ok';
        return new Response(json_encode($result), 200);
    }


    /**
    * @Route("/usuario/{id}/edit", name="usuario_edit")
    */

    public function editar($id, Request $usuario){

        //tranformamos el archivo Json
        $data = json_decode($usuario->getContent(), true);
        $usuario->request->replace($data);


        $usuManager = $this->getDoctrine()->getManager();

        //creamos una usuario
        $usu = $usuManager -> getRepository(usuario::class) -> find($id);
        $usu->setNombres($usuario->request->get('nombres'));
        $usu->setApellido($usuario->request->get('apellido'));
        $usu->setUsuario($usuario->request->get('usuario'));
        $usu->setPassword($usuario->request->get('password'));
        $usu->setEmail($usuario->request->get('email'));
        $usu->setPerfil($usuario->request->get('perfil'));

        //guardamos en la bd        
        
        $usuManager->persist($usu);
        $usuManager->flush();
        
        $result['status'] = 'ok';
        return new Response(json_encode($result), 200);
    }

    
     /**
     * @Route("/{id}/delete", name="usuario_delete")
     */

    public function borrar($id)
    {
        $usuManager = $this->getDoctrine()->getManager();
        $usuario = $usuManager->getRepository(Usuario::class)->find($id);
        if (!$usuario){
            throw $this->createNotFoundException('id incorrecta');
        }
        $usuManager->remove($usuario);
        $usuManager->flush();
        $result['status'] = 'ok';
        return new Response(json_encode($result), 200);
    }
}
