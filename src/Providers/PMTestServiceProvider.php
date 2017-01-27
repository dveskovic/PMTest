<?php
namespace PMTest\Providers;

use Plenty\Plugin\ServiceProvider;


/**
 * Class PMTestServiceProvider
 * @package PMTest\Providers
 */
class PMTestServiceProvider extends ServiceProvider
{

	/**
	 * Register the service provider.
	 */
	public function register()
	{
		$this->getApplication()->register(PMTestRouteServiceProvider::class);

	}


}
