<?php

namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\ODM\MongoDB\Types\Type as Type;

#[MongoDB\EmbeddedDocument]
class Savings
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

    #[MongoDB\Field(type: Type::INTEGER)]
    private $percentage;

    public function __construct()
    { 
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

    public function getPercentage()
    {
        return $this->percentage;
    }

    public function setPercentage($percentage)
    {
        $this->percentage =  $percentage;  
    }

    
}