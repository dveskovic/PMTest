<?php
namespace PMTest\Controllers;

use Plenty\Plugin\Controller;
use Plenty\Plugin\Templates\Twig;
use Plenty\Modules\Helper\Services\WebstoreHelper;
use Plenty\Modules\Frontend\Services;
use Plenty\Modules\System\Models;

use Plenty\Plugin\Http\Response;
use Plenty\Plugin\Http\Request;
use IO\Services\ItemService;

/**
 * Class ContentController
 * @package PMTest\Controllers
 */
class DataController extends Controller
{

    const YC_DIRECTORY_NAME = 'yoochoose';
    const LAYOUT = 'layout/callisto_en_3';

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
     * @var WebstoreHelper
     */
    private $storeHelper;



    public function __construct(
        Response $response,
        Request $request,
        ItemService $service,
        WebstoreHelper $storeHelper,
        Models\webstoreConfiguration $webstoreConfiguration)
    {
        $this->response = $response;
        $this->request = $request;
        $this->itemService = $service;
        $this->storeHelper = $storeHelper;
        $this->storeConfiguration = $webstoreConfiguration;
    }

    /**
     * Returning item details
     *
     */
    public function export()
    {

/*        $productIds = $this->request->get('productIds');
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
        /** @var \Plenty\Modules\System\Models\WebstoreConfiguration $webstoreConfig */
        $webstoreConfig = $this->storeHelper->getCurrentWebstoreConfiguration();
        if (is_null($webstoreConfig)) {
            return 'error';
        }
        $baseURL = $webstoreConfig->domain;
        $t = 'https://test22.plentymarkets-cloud01.com/layout/callisto_en_3/';
       // $directory = $baseURL . '/'. self::LAYOUT . '/' . self::YC_DIRECTORY_NAME . '/';
        //mkdir($directory, 0777, true);

        $test = ['test' =>  $t];

        return $this->response->json($test);
    }
}
