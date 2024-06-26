<?php

namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\ODM\MongoDB\Types\Type as Type;


use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

#[MongoDB\EmbeddedDocument]
class ItemInfo
{
    private $encoders;
    private $normalizers;     
    private $serializer;

    #[MongoDB\EmbedOne(targetDocument: ByLineInfo::class)]
    private $byLineInfo;

    #[MongoDB\EmbedOne(targetDocument: Features::class)]
    private $features;

    #[MongoDB\EmbedOne(targetDocument: BasicInfo::class)]
    private $title;


    public function __construct()
    {
        $this->encoders = [new XmlEncoder(), new JsonEncoder()];
        $this->normalizers = [new ObjectNormalizer()];     
        $this->serializer = new Serializer($this->normalizers, $this->encoders);
    }

    public function getByLineInfo()
    {
        return $this->byLineInfo;
    }

    public function setByLineInfo($byLineInfo)
    {
        $this->byLineInfo =  $this->serializer->deserialize(json_encode($byLineInfo), ByLineInfo::class, 'json');  
    }

    public function getFeatures()
    {
        return $this->features;
    }

    public function setFeatures($features)
    {
        $this->features =  $this->serializer->deserialize(json_encode($features), Features::class, 'json');  
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title =  $this->serializer->deserialize(json_encode($title), BasicInfo::class, 'json');  
    }

}