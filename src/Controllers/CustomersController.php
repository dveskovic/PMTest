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
        $param = '';
        $group = $this->request->get('group');
        $subscribed = $this->request->get('subscribed');
        $emails = $this->request->get('emails');
        $emails = json_decode($emails, true);
        if (isset($group) && isset($subscribed) == false){
            $param = 1;
        }
        if (isset($group) && isset($subscribed) && $subscribed == 'true'){
            $param = 2;
        }
        if (isset($group) && isset($subscribed) && $subscribed == 'false'){
            $param = 3;
        }
        if (isset($subscribed) && isset($group) == false && $subscribed == 'true'){
            $param = 4;
        }
        if (isset($subscribed) && isset($group) == false && $subscribed == 'false'){
            $param = 5;
        }
        if (isset($group) && isset($emails)){
            $param = 6;
        }
        $accounts = $this->account->allAccounts();
        foreach ($accounts as $a){
            $contacts = $this->account->getContactsOfAccount($a->id);
            foreach ($contacts as $contact){
                $contact['companyName'] = $a->companyName;
                $contact['taxIdNumber'] = $a->taxIdNumber;
                switch ($param) {
                    case 1:
                        if($contact['typeId'] == $group){
                            $result[] = $contact;
                        }
                        break;
                    case 2:
                        if($contact['typeId'] == $group && $contact['newsletterAllowanceAt'] != null) {
                            $result[] = $contact;
                        }
                        break;
                    case 3:
                        if($contact['typeId'] == $group) {
                            $result[] = $contact;
                        }
                        break;
                    case 4:
                        if($contact['newsletterAllowanceAt'] != null){
                            $result[] = $contact;
                        }
                        break;
                    case 5:
                    {
                        $result[] = $contact;
                    }
                        break;
                    case 6:
                    {
                        if($contact['typeId'] == $group) {
                            
                        foreach($contact['options'] as $option){
                            foreach($emails as $email){
                                if($option['typeId'] == 2 && $option['subTypeId'] == 4 && $option['value'] == $email){
                                    $result[] = $contact;
                                }
                            }
                        }
                        }
                    }
                        break;
                    default:
                        $result[] = $contact;
                        break;
                }
            }
        }
        return $this->response->json($result);
    }
}