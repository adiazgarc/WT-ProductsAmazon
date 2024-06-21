<?php

namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\ODM\MongoDB\Types\Type as Type;

#[MongoDB\Document(db: "shop", collection: "products")]
class Product
{

    #[MongoDB\Id]
    private $id;

    #[MongoDB\Field(type: Type::STRING)]
    private $asin;


    /**
     * @param $path
     */
    public function __construct($asin)
    {
        $this->asin = $asin;
    }

    
}