<?php
namespace PMTest\Controllers;

use Plenty\Plugin\Controller;
use Plenty\Modules\Frontend\Services;
use Plenty\Modules\System\Models;
use Plenty\Modules\Account\Contracts\AccountRepositoryContract;
use Plenty\Plugin\Http\Response;
use Plenty\Plugin\Http\Request;
use IO\Api\ApiResource;
use IO\Api\ApiResponse;


/**
 * Class CustomersController
 * @package PMTest\Controllers
 */
class CustomersController extends Controller
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
     * @var AccountRepositoryContract
     */
    private $account;

    /**
     * @var ApiResource
     */
    private $apiResource;

    /**
     * @var ApiResponse
     */
    private $apiResponse;




    public function __construct(
        Response $response,
        Request $request,
        ApiResource $apiResource,
        ApiResponse $apiResponse,
        AccountRepositoryContract $account)
    {
        $this->response = $response;
        $this->request = $request;
        $this->account = $account;
        $this->apiResource = $apiResource;
        $this->apiResponse = $apiResponse;

    }

    /**
     * Returning customer details
     *
     */
    public function customers()
    {

        $test = $this->apiResource->index();
        $productIds = $this->request->get('productIds');
        $productIds = isset($productIds) ? explode(',', $productIds) : null;

        $accounts = $this->account->allAccounts();
        foreach ($accounts as $ac){
            $data[] = [
                'id' => $ac->id,
                'companyName' => $ac->companyName,
                'taxIdNumber' => $ac->taxIdNumber,
            ];
        $contacts = $this->account->getContactsOfAccount($ac->id);
        $data[]['contacts'] = $contacts;
        }

        return $this->response->json($data);
    }
}
