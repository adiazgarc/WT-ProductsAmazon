<?php

namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\ODM\MongoDB\Types\Type as Type;


use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

#[MongoDB\EmbeddedDocument]
class BrowseNodeInfo
{
    private $encoders;
    private $normalizers;     
    private $serializer;

    public function __construct()
    {
        $this->encoders = [new XmlEncoder(), new JsonEncoder()];
        $this->normalizers = [new ObjectNormalizer()];     
        $this->serializer = new Serializer($this->normalizers, $this->encoders);
    }

    #[MongoDB\EmbedOne(targetDocument: BrowseNodes::class)]
    private $browseNodes;

    public function getBrowseNodes()
    {
        return $this->browseNodes;
    }

    public function setBrowseNodes($browseNodes)
    {
        $this->browseNodes =  $this->serializer->deserialize(json_encode($browseNodes[0]), BrowseNodes::class, 'json');  
    }

}