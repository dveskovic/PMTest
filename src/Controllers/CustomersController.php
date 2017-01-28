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
     * @return BaseResponse
     */
	public function index():BaseResponse
	{
		
		return $this->response->create(null, $this->defaultCode);
	}
}
