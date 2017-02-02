<?php
namespace PMTest\Controllers;
use Plenty\Plugin\Controller;
use Plenty\Modules\Frontend\Services;
use Plenty\Modules\System\Models;
use Plenty\Modules\Account\Contracts\AccountRepositoryContract;
use Plenty\Modules\Account\Contact\Contracts\ContactOptionRepositoryContract;
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
     * @var ContactOptionRepositoryContract
     */
    private $contactType;

    public function __construct(
        Response $response,
        Request $request,
        AccountRepositoryContract $account,
        ContactOptionRepositoryContract $contactType)
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

        $contactData = $this->contactType->findContactOptions(104, 2, 4);
        return $this->response->json($contactData);
    }
}