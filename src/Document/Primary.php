<?php

namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\ODM\MongoDB\Types\Type as Type;

use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

#[MongoDB\EmbeddedDocument]
class Primary 
{

    private $encoders;
    private $normalizers;     
    private $serializer;

    #[MongoDB\EmbedOne(targetDocument: Large::class)]
    private $large;

    public function __construct()
    {
        $this->encoders = [new XmlEncoder(), new JsonEncoder()];
        $this->normalizers = [new ObjectNormalizer()];     
        $this->serializer = new Serializer($this->normalizers, $this->encoders);
    }

    public function getLarge()
    {
        return $this->large;
    }

    public function setLarge($large)
    {
        $this->large =  $this->serializer->deserialize(json_encode($large), Large::class, 'json');  
    }

}