<?php

namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\ODM\MongoDB\Types\Type as Type;

#[MongoDB\EmbeddedDocument]
class DeliveryInfo
{
    private $encoders;
    private $normalizers;     
    private $serializer;

    #[MongoDB\Field(type: Type::BOOLEAN)]
    private $isFreeShippingEligible;

    public function __construct()
    { 
    }

    public function getIsFreeShippingEligible()
    {
        return $this->isFreeShippingEligible;
    }

    public function setIsFreeShippingEligible($isFreeShippingEligible)
    {
        $this->isFreeShippingEligible =  $isFreeShippingEligible;  
    }

}