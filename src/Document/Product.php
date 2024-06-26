<?php

namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use Doctrine\ODM\MongoDB\Types\Type as Type;

use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

#[MongoDB\Document(db: "shop", collection: "products")]
class Product
{
    private $encoders;
    private $normalizers;     
    private $serializer;

    #[MongoDB\Id]
    private $id;

    #[MongoDB\Field(type: Type::STRING)]
    private $asin;

    #[MongoDB\EmbedOne(targetDocument: BrowseNodeInfo::class)]
    private $browseNodeInfo;

    #[MongoDB\Field(type: Type::STRING)]
    private $detailPageUrl;

    #[MongoDB\EmbedOne(targetDocument: Images::class)]
    private $images;

    #[MongoDB\EmbedOne(targetDocument: ItemInfo::class)]
    private $itemInfo;
  
    #[MongoDB\EmbedOne(targetDocument: Offers::class)]
    private $offers;
    

   
    public function __construct()
    {
        $this->encoders = [new XmlEncoder(), new JsonEncoder()];
        $this->normalizers = [new ObjectNormalizer()];
        $this->serializer = new Serializer($this->normalizers, $this->encoders);
    }
 


   public function getAsin()
    {
        return $this->asin;
    }

    public function setAsin($asin)
    {
        $this->asin = $asin;
    }

    public function getBrowseNodeInfo()
    {
        return $this->browseNodeInfo;
    }

    public function setBrowseNodeInfo($browseNodeInfo)
    {
        $this->browseNodeInfo =  $this->serializer->deserialize(json_encode($browseNodeInfo), BrowseNodeInfo::class, 'json'); 
    }

    public function getDetailPageUrl()
    {
        return $this->detailPageUrl;
    }

    public function setDetailPageUrl($detailPageUrl)
    {
        $this->detailPageUrl = $detailPageUrl;
    }

    public function getImages()
    {
        return $this->images;
    }

    public function setImages($images)
    {
        $this->images =  $this->serializer->deserialize(json_encode($images), Images::class, 'json'); 
    }

    public function getItemInfo()
    {
        return $this->itemInfo;
    }

    public function setItemInfo($itemInfo)
    {
        $this->itemInfo =  $this->serializer->deserialize(json_encode($itemInfo), ItemInfo::class, 'json'); 
    }

    public function getOffers()
    {
        return $this->offers;
    }

    public function setOffers($offers)
    {
        $this->offers =  $this->serializer->deserialize(json_encode($offers), Offers::class, 'json');  
    }
}