<?php

namespace App\Controller;

use Doctrine\ODM\MongoDB\DocumentManager;
use App\Document\Product;
use App\Document\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Filesystem\Filesystem;

use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Security\Http\Attribute\IsGranted;
class ProductController extends AbstractController
{
    /**
     * @var \Doctrine\ODM\MongoDB\DocumentManager
     */
    private $_dm;

    private $passwordEncoder;



    public function __construct()
    { 
    }

    #[IsGranted('ROLE_ADMIN', message: 'You are not allowed to access the product list.')]
    #[Route('/', name: 'new_product', methods: ['GET'])]
    public function new(DocumentManager $dm)
    {

        $products = $dm->getRepository(Product::class)->findAll();

        //If it is empty (the cron has not yet loaded products)
        if (count($products)<1) { 
            $this->loadData($dm);
            $products = $dm->getRepository(Product::class)->findAll();
        }

        return $this->render('catalog/products.html.twig', array('products'=> $products));

    }

    public function loadData(DocumentManager $dm){      
      
        $encoders = [new XmlEncoder(), new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);

        $serializer = new Serializer($normalizers, $encoders);

        $filesystem = new Filesystem();

        //Empty collection for new load all products
        $collection = $dm->getDocumentCollection(Product::class);
        $collection->drop();

        //Read json
        $contents = $filesystem->readFile('/var/www/html/data/amazon.json');
        $jsonData = json_decode($contents, true);

        //Save every product
        foreach ($jsonData["SearchResult"]["Items"] as $key => $value) {
            $product = $serializer->deserialize(json_encode($value), Product::class, 'json');
            $dm->persist($product);
            $dm->flush();
        }

    }
}
