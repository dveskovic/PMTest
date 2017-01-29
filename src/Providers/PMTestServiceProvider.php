<?php
namespace PMTest\Providers;

use Plenty\Plugin\ServiceProvider;
use Plenty\Plugin\Templates\Twig;
use Plenty\Plugin\Events\Dispatcher;
use Plenty\Plugin\ConfigRepository;
use Plenty\Modules\Frontend\Services;
use Plenty\Modules\Template\Design\Config\Models;

use IO\Helper\TemplateContainer;


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
		$events = $this->getEventDispatcher();
	}

	public function boot(Twig $twig, Dispatcher $eventDispatcher, ConfigRepository $config)
	{

		$twig->addExtension('Twig_Extension_StringLoader');

		$eventDispatcher->listen('tpl.category.container', function(TemplateContainer $container, $templateData) {

		}, 0);

	}

}
