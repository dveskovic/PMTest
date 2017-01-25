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

        $productIds = $this->request->get('productIds');
        $productIds = isset($productIds) ? explode(',', $productIds) : null;

        $accounts = $this->account->allAccounts();
        foreach ($accounts as $ac){
            $contacts = $this->account->getContactsOfAccount($ac->id);
            if($contacts['options']['typeId'] == 2 && $contacts['options']['subTypeId'] == 4){
                $email = $contacts['options']['value'];
            }else{
                $email = null;
            }
            $data[] = [
                'id' => $ac->id,
                'companyName' => $ac->companyName,
                'taxIdNumber' => $ac->taxIdNumber,
                'address' => $email,
            ];

        }

        return $this->response->json($data);
    }
}
