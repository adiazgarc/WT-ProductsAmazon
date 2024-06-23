<?php

namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\ODM\MongoDB\Types\Type as Type;

use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

#[MongoDB\EmbeddedDocument]
class Price
{
    private $encoders;
    private $normalizers;     
    private $serializer;

    #[MongoDB\Field(type: Type::FLOAT)]
    private $amount;

    #[MongoDB\Field(type: Type::STRING)]
    private $currency;


    #[MongoDB\Field(type: Type::STRING)]
    private $displayAmount;

    #[MongoDB\EmbedOne(targetDocument: Savings::class)]
    private $savings;

    public function __construct()
    { 
        $this->encoders = [new XmlEncoder(), new JsonEncoder()];
        $this->normalizers = [new ObjectNormalizer()];     
        $this->serializer = new Serializer($this->normalizers, $this->encoders);
    }

    public function getAmount()
    {
        return $this->amount;
    }

    public function setAmount($amount)
    {
        $this->amount =  $amount;  
    }

    public function getCurrency()
    {
        return $this->currency;
    }

    public function setCurrency($currency)
    {
        $this->currency =  $currency;  
    }

    public function getDisplayAmount()
    {
        return $this->displayAmount;
    }

    public function setDisplayAmount($displayAmount)
    {
        $this->displayAmount =  $displayAmount;  
    }

    public function getSavings()
    {
        return $this->savings;
    }

    public function setSavings($savings)
    {
        $this->savings =  $this->serializer->deserialize(json_encode($savings), Savings::class, 'json');  
    }

}