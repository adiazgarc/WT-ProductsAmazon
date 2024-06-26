<?php

namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\ODM\MongoDB\Types\Type as Type;


#[MongoDB\EmbeddedDocument]
class Features
{
    private $encoders;
    private $normalizers;     
    private $serializer;

    #[MongoDB\Field(type: Type::COLLECTION)]
    private $displayValues;

    #[MongoDB\Field(type: Type::STRING)]
    private $label;

    #[MongoDB\Field(type: Type::STRING)]
    private $locale;


    public function __construct()
    {
    }

    public function getDisplayValues()
    {
        return $this->displayValues;
    }

    public function setDisplayValues($displayValues)
    {
        $this->displayValues =  $displayValues;  
    }

    public function getLabel()
    {
        return $this->label;
    }

    
    public function setLabel($label)
    {
        $this->label =  $label;  
    }
    
    public function getLocale()
    {
        return $this->locale;
    }

    
    public function setLocale($locale)
    {
        $this->locale =  $locale;  
    }


}