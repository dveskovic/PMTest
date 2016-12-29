<?php
namespace PMTest\Controllers;

use Plenty\Plugin\Controller;
use Plenty\Plugin\ConfigRepository;
use Plenty\Plugin\Templates\Twig;
use Plenty\Modules\Frontend\Services;
use Plenty\Modules\System\Models;
use Plenty\Plugin\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use IO\Services\ItemService;
use IO\Helper\TemplateContainer;
// \Symfony\Component\HttpFoundation\
/**
 * Class ContentController
 * @package PMTest\Controllers
 */
class IndexController extends Controller
{

    /**
     * @var null|Request
     */
    private $request = null;
    /**
     * @var null|Response
     */
    private $response = null;

    public function __construct(
        Request $request,
        Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    /**
     * @param Twig $twig
     * @param Models\WebstoreConfiguration $designConfig
     * @return Response
     */
    public function execute(Twig $twig, Models\WebstoreConfiguration $designConfig):string 
    {
        $productIds	= $this->request->get('productIds');

        //$productIds = isset($productIds) ? explode(',', $productIds) : null;

        //$currentItem = $itemService->getItem($itemId);
        // $products = [];
        /*	$products[] = [
                'id' => $product->getId(),
                'link' => $product->getUrlModel()->getUrl($product),
                'price' => $priceHelper->currency($product->getFinalPrice(), true, false),
                'image' => ($image ? $helper->getMediaUrl($image) : ($thumbnailHolder ? $placeholderPath : null)),
                'title' => $product->getName(),
            ];*/

        $test = ['test' => $productIds];

        return $this->response.json_encode($test);
    }
}
