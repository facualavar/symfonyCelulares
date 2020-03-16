<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class SubSubCategoriaController extends AbstractController
{
    /**
     * @Route("/sub/sub/categoria", name="sub_sub_categoria")
     */
    public function index()
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/SubSubCategoriaController.php',
        ]);
    }
}
