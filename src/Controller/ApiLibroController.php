<?php

namespace App\Controller;

use App\Repository\LibroRepository;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

use Symfony\Component\Routing\Attribute\Route;




#[Route('/api', name: 'app_api_')]
final class ApiLibroController extends AbstractController
{


    #[Route('/libros', name: 'libros', methods: ['GET'])]
    public function index(LibroRepository $repo): JsonResponse
    {
        return $this->json($repo->findAll());
    }

}