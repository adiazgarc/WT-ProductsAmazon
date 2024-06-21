<?php

namespace App\Controller;

use Doctrine\ODM\MongoDB\DocumentManager;
use App\Document\Product;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class ProductController extends AbstractController
{
    /*#[Route('/product', name: 'app_product')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/ProductController.php',
        ]);
    }*/

    #[Route('/products', name: 'new_product', methods: ['GET'])]
    public function new(DocumentManager $documentManager)
    {
        $product = new Product("1234");


        $documentManager->persist($product);
        $documentManager->flush();
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/ProductController.php',
        ]);
    }
}
