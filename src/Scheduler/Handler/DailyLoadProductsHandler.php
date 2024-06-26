<?
// src/Scheduler/Handler/DailyLoadProductsHandler.php
namespace App\Scheduler\Handler;

use App\Controller\ProductController;
use App\Scheduler\Message\DailyLoadProducts;
use Symfony\Component\HttpKernel\KernelInterface;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Doctrine\ODM\MongoDB\DocumentManager;


#[AsMessageHandler]
class DailyLoadProductsHandler
{

    /**
    * @var DocumentManager
    */
    protected $dm;

    public function __construct(DocumentManager $dm)
    {
     $this->dm = $dm;
    }

    public function __invoke(DailyLoadProducts $message)
    {
        $productController = new ProductController();  
        $productController->loadData($this->dm);
    }
}