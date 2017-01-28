<?php
namespace PMTest\Controllers;

//use Plenty\Plugin\Controller;
use Plenty\Modules\Account\Contracts\AccountRepositoryContract;
use Symfony\Component\HttpFoundation\Response as BaseResponse;
use IO\Api\ApiResource;
use IO\Api\ApiResponse;


/**
 * Class CustomersController
 * @package PMTest\Controllers
 */
class CustomersController extends ApiResource
{

    /**
     * @var null|ApiResponse
     */
    private $response;


    /**
     * @var AccountRepositoryContract
     */
    private $account;


    public function __construct(
        ApiResponse $response,
        AccountRepositoryContract $account)
    {
        $this->response = $response;
        $this->account = $account;
    }

    /**
     * @param string $selector
     * @return BaseResponse
     */
    public function show(string $selector):BaseResponse
    {

        $data = [];
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

        return $this->response->create($data, $this->defaultCode);
    }
}
