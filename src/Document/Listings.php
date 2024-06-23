<?php

namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\ODM\MongoDB\Types\Type as Type;

use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

#[MongoDB\EmbeddedDocument]
class Listings
{
    private $encoders;
    private $normalizers;     
    private $serializer;

    #[MongoDB\EmbedOne(targetDocument: DeliveryInfo::class)]
    private $deliveryInfo;


    #[MongoDB\Field(type: Type::STRING)]
    private $id;

    #[MongoDB\EmbedOne(targetDocument: Price::class)]
    private $price;

    #[MongoDB\Field(type: Type::BOOLEAN)]
    private $violatesMAP;

    public function __construct()
    {
        $this->encoders = [new XmlEncoder(), new JsonEncoder()];
        $this->normalizers = [new ObjectNormalizer()];     
        $this->serializer = new Serializer($this->normalizers, $this->encoders);
    }

    public function getDeliveryInfo()
    {
        return $this->deliveryInfo;
    }

    public function setDeliveryInfo($deliveryInfo)
    {
        $this->deliveryInfo =  $this->serializer->deserialize(json_encode($deliveryInfo), DeliveryInfo::class, 'json');  
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id =  $id;  
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price =  $this->serializer->deserialize(json_encode($price), Price::class, 'json');  
    }

    public function getViolatesMAP()
    {
        return $this->violatesMAP;
    }

    public function setViolatesMAP($violatesMAP)
    {
        $this->violatesMAP =  $violatesMAP;  
    }

}