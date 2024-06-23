<?php

namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\ODM\MongoDB\Types\Type as Type;


use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

#[MongoDB\EmbeddedDocument]
class Large
{
    #[MongoDB\Field(type: Type::STRING)]
    private $height;

    #[MongoDB\Field(type: Type::STRING)]
    private $width;

    #[MongoDB\Field(type: Type::STRING)]
    private $url;


    public function getHeight()
    {
        return $this->height;
    }

    public function setHeight($height)
    {
        $this->height = $height;
    }

    public function getWidth()
    {
        return $this->width;
    }

    public function setWidth($width)
    {
        $this->width =  $width;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function setUrl($url)
    {
        $this->url =  $url;
    }


}