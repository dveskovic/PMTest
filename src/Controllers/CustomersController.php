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
     * @var ApiResponse
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

	
	public function customers()
	{
		$data = 'test';
	
		return $data;
		
	}
}
