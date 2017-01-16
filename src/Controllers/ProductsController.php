<?php
namespace PMTest\Controllers;

use Plenty\Plugin\Controller;
use Plenty\Plugin\Templates\Twig;
use Plenty\Modules\Frontend\Services;
use Plenty\Modules\System\Models;

use Plenty\Plugin\Http\Response;
use Plenty\Plugin\Http\Request;
use IO\Services\ItemService;

/**
 * Class ContentController
 * @package PMTest\Controllers
 */
class ProductsController extends Controller
{

    /**
     * @var null|Response
     */
    private $response;

    /**
     * @var Response
     */
    private $request;

    /**
     * @var ItemService
     */
    private $itemService;

    /**
     * @var Models\webstoreConfiguration
     */
    private $storeConfiguration;



    public function __construct(
        Response $response,
        Request $request,
        ItemService $service,
        Models\webstoreConfiguration $webstoreConfiguration)
    {
        $this->response = $response;
        $this->request = $request;
        $this->itemService = $service;
        $this->storeConfiguration = $webstoreConfiguration;
    }

    /**
     * Returning item details
     *
     */
    public function productsExport()
    {

   /*     $productIds = $this->request->get('productIds');
        $productIds = isset($productIds) ? explode(',', $productIds) : null;
        $storeConf = $this->storeConfiguration->toArray();

        foreach ($productIds as $productId) {
            $product = $this->itemService->getItem($productId);
            $products[] = [
                'id' => $product->itemBase->id,
                'link' => $this->itemService->getItemURL($product->itemBase->id),
                'price' => $product->variationRetailPrice->price,
                'image' => $this->itemService->getItemImage($product->itemBase->id),
                'title' => $product->itemDescription->name1,
            ];
        }*/

        $obj = new stdClass;
        $obj->itemsPerPage = 10;
        //$params = (object) ['itemsPerPage' => 3];
        $product = $this->itemService->searchItems('two', $obj);
      //  return $this->response->json($products);
        echo 'tu saaaam';
    }
}
