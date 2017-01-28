<?php
namespace PMTest\Controllers;

//use Plenty\Plugin\Controller;
use Plenty\Modules\Account\Contracts\AccountRepositoryContract;
use Symfony\Component\HttpFoundation\Response as BaseResponse;


/**
 * Class CustomersController
 * @package PMTest\Controllers
 */
class CustomersController extends Controller
{

 


    /**
     * @var AccountRepositoryContract
     */
    private $account;


    public function __construct(
     
        AccountRepositoryContract $account)
    {
      
        $this->account = $account;
    }

	
	public function customers()
	{
		$data = 'test';
	
		return $data;
		
	}
}
