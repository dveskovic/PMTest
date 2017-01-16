<?php
namespace PMTest\Controllers;

use Plenty\Plugin\Controller;
use Plenty\Plugin\Templates\Twig;
use Plenty\Modules\Frontend\Services;
use Plenty\Modules\System\Models;

use Plenty\Plugin\Http\Response;
use Plenty\Plugin\Http\Request;
use IO\Services\CategoryService;

/**
 * Class ContentController
 * @package PMTest\Controllers
 */
class CategoryController extends Controller
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
    private $categoryService;

    /**
     * @var Models\webstoreConfiguration
     */
    private $storeConfiguration;



    public function __construct(
        Response $response,
        Request $request,
        CategoryService $service,
        Models\webstoreConfiguration $webstoreConfiguration)
    {
        $this->response = $response;
        $this->request = $request;
        $this->categoryService = $service;
        $this->storeConfiguration = $webstoreConfiguration;
    }

    /**
     * Returning item details
     *
     */
    public function categoryExport()
    {


     /*   $products = $this->categoryService->getHierarchy();


        return $this->response->json($products);*/
        echo 'aa';
    }
}
