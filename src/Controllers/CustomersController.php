<?php
namespace PMTest\Controllers;

use Plenty\Plugin\Controller;
use Plenty\Modules\Frontend\Services;
use Plenty\Modules\System\Models;
use Plenty\Modules\Account\Contracts\AccountRepositoryContract;
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


    public function __construct(
        Response $response,
        Request $request,
        AccountRepositoryContract $account)
    {
        $this->response = $response;
        $this->request = $request;
        $this->account = $account;
    }

    /**
     * Returning customer details
     *
     */
    public function customers()
    {
        $result = '';
        $group = $this->request->get('group');
		$subscribed = $this->request->get('subscribed');

        $accounts = $this->account->allAccounts();
        foreach ($accounts as $a){
        $contacts = $this->account->getContactsOfAccount($a->id);
            foreach ($contacts as $contact){
                $contact['companyName'] = $a->companyName;
                $contact['taxIdNumber'] = $a->taxIdNumber;
                if (isset($group)) {
                    if($contact['typeId'] == $group){
						$result[] = (isset($subscribed) && $subscribed == true && $contact['newsletterAllowanceAt'] != null) ? $contact : '' ;
                    }
                }else{
                    $result[] = $contact;
                }
            }
        }

        return $this->response->json($result);
    }
}
