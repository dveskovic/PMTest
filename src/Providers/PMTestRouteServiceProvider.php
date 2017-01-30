<?php
namespace PMTest\Providers;

use Plenty\Plugin\RouteServiceProvider;
use Plenty\Plugin\Routing\Router;

/**
 * Class PMTestRouteServiceProvider
 * @package PMTest\Providers
 */
class PMTestRouteServiceProvider extends RouteServiceProvider
{
	/**
	 * @param Router $router
	 */
	public function map(Router $router)
	{
		$router->get('n2go/customers', 'PMTest\Controllers\CustomersController@customers');
	}

}
