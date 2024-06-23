<?php

namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\ODM\MongoDB\Types\Type as Type;


use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

#[MongoDB\EmbeddedDocument]
class Images
{
    private $encoders;
    private $normalizers;     
    private $serializer;

    #[MongoDB\EmbedOne(targetDocument: Primary::class)]
    private $primary;

    public function __construct()
    {
        $this->encoders = [new XmlEncoder(), new JsonEncoder()];
        $this->normalizers = [new ObjectNormalizer()];     
        $this->serializer = new Serializer($this->normalizers, $this->encoders);
    }

    public function getPrimary()
    {
        return $this->primary;
    }

    public function setPrimary($primary)
    {
        $this->primary =  $this->serializer->deserialize(json_encode($primary), Primary::class, 'json');  
    }

}