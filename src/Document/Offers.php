<?php

namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\ODM\MongoDB\Types\Type as Type;


use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

#[MongoDB\EmbeddedDocument]
class Offers
{
    private $encoders;
    private $normalizers;     
    private $serializer;

    #[MongoDB\EmbedOne(targetDocument: Listings::class)]
    private $listings;


    public function __construct()
    {
        $this->encoders = [new XmlEncoder(), new JsonEncoder()];
        $this->normalizers = [new ObjectNormalizer()];     
        $this->serializer = new Serializer($this->normalizers, $this->encoders);
    }

    public function getListings()
    {
        return $this->listings;
    }

    public function setListings($listings)
    {
       $this->listings =  $this->serializer->deserialize(json_encode($listings[0]), Listings::class, 'json');  
    }


}