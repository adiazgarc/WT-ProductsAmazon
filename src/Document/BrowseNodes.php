<?php

namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\ODM\MongoDB\Types\Type as Type;


#[MongoDB\EmbeddedDocument]
class BrowseNodes 
{

    #[MongoDB\Field(type: Type::STRING)]
    private $contextFreeName;

    #[MongoDB\Field(type: Type::STRING)]
    private $displayName;

    #[MongoDB\Field(type: Type::STRING)]
    private $id;

    #[MongoDB\Field(type: Type::BOOLEAN)]
    private $isRoot; 

    #[MongoDB\Field(type: Type::INTEGER)]
    private $salesRank;

    public function getDisplayName()
    {
        return $this->displayName;
    }

    public function setDisplayName($displayName)
    {
        $this->displayName = $displayName;
    }

    public function getContextFreeName()
    {
        return $this->contextFreeName;
    }

    public function setContextFreeName($contextFreeName)
    {
        $this->contextFreeName =  $contextFreeName;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
        $this->id =  $id;
    }

    public function getIsRoot()
    {
        return $this->isRoot;
    }

    public function setIsRoot($isRoot)
    {
        $this->isRoot =  $isRoot;
    }

    public function getSalesRank()
    {
        return $this->salesRank;
    }

    public function setSalesRank($salesRank)
    {
        $this->salesRank =  $salesRank;
    }

}