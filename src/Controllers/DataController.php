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
use Plenty\Modules\Plugin\Storage\Contracts;


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

    /**
     * @var Contracts
     */
    private $storage;



    public function __construct(
        Response $response,
        Request $request,
        ItemService $service,
        WebstoreHelper $storeHelper,
        Contracts\StorageRepositoryContract $storage,
        Models\webstoreConfiguration $webstoreConfiguration)
    {
        $this->response = $response;
        $this->request = $request;
        $this->itemService = $service;
        $this->storeHelper = $storeHelper;
        $this->storage = $storage;
        $this->storeConfiguration = $webstoreConfiguration;
    }

    /**
     * Returning item details
     *
     */
    public function export()
    {

        $webstoreConfig = $this->storeHelper->getCurrentWebstoreConfiguration();
        if (is_null($webstoreConfig)) {
            return 'error';
        }
        $baseURL = $webstoreConfig->domain;
        //$t = 'https://test22.plentymarkets-cloud01.com/layout/callisto_en_3/testing';
        $directory = $baseURL . '/'. self::LAYOUT . '/';
        //mkdir($directory, 0777, true);
        $results = array("name" => "testProduct", "color" => "red");
        $filename = $this->generateRandomString() . '.json';
        $file = $directory . $filename;
        $fileContent = json_encode(array_values($results));
       // write($file, json_encode(array_values($results)));
       // $fileSize = filesize($file);
        $test2 = '22';
        $this->storage->uploadFile('pmtest', $fileContent, $file, true, null);

    /*    public function uploadFile(
        string $pluginName,
        string $key,
        string $pathToFile,
        boolean $publicVisible = false,
        array $metaData = []
    ):boolean;*/

        $test = ['test' => $directory];

        return $this->response->json($test);
    }



    /**
     * Generates random string with $length characters
     *
     * @param int $length
     * @return string
     */
    private function generateRandomString($length = 20)
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }

        return $randomString;
    }
}
