<?php
namespace PMTest\Controllers;

use Plenty\Plugin\Controller;
use Plenty\Plugin\Templates\Twig;
use Plenty\Modules\Frontend\Services;
use Plenty\Modules\System\Models;

use Plenty\Plugin\Http\Response;
use Plenty\Plugin\Http\Request;
use IO\Services\ItemService;
use PMTest\Helpers\Api;



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

    /**
     * @var Api
     */
    private $helper;

    public function __construct(
        Response $response,
        Request $request,
        Api $helper,
        ItemService $service,
        Models\webstoreConfiguration $webstoreConfiguration)
    {
        $this->helper = $helper;
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

        $page = $this->request->get('page');
        $itemsPerPage = $this->request->get('itemsPerPage');
        $page = isset($page) ? $page : 0;
        $itemsPerPage = isset($itemsPerPage) ? $itemsPerPage : 10;

        $response = $this->helper->getHttpPage($page, $itemsPerPage);
        $result = json_decode($response);

        if ($result['statusCode'] == 200) {
            return $this->response->json('User verification successful');
        } else {
            return $this->response->json('User is not verified!');
        }

    /*    $storeConf = $this->storeConfiguration->toArray();

        foreach ($productIds as $productId) {
            $product = $this->itemService->getItem($productId);
            $products[] = [
                'id' => $product->itemBase->id,
                'link' => $this->itemService->getItemURL($product->itemBase->id),
                'price' => $product->variationRetailPrice->price,
                'image' => $this->itemService->getItemImage($product->itemBase->id),
                'title' => $product->itemDescription->name1,
            ];
        }


        return $this->response->json($products);*/
    }
}
