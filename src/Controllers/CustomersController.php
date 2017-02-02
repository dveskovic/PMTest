<?php
namespace PMTest\Controllers;
use Plenty\Plugin\Controller;
use Plenty\Modules\Frontend\Services;
use Plenty\Modules\System\Models;
use Plenty\Modules\Account\Contracts\AccountRepositoryContract;
use Plenty\Modules\Account\Contact\Contracts\ContactTypeRepositoryContract;
use Plenty\Plugin\Http\Response;
use Plenty\Plugin\Http\Request;

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
     * @var ContactTypeRepositoryContract
     */
    private $contactType;

    public function __construct(
        Response $response,
        Request $request,
        AccountRepositoryContract $account,
        ContactTypeRepositoryContract $contactType)
    {
        $this->response = $response;
        $this->request = $request;
        $this->account = $account;
        $this->contactType = $contactType;
    }


    /**
     * Returning customer details
     *
     */
    public function customers()
    {

        $contactData = $this->contactType->findContactTypeById(1);
        return $this->response->json($contactData);
    }
}