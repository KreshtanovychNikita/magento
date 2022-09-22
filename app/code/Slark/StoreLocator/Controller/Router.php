<?php
namespace Slark\StoreLocator\Controller;

use Magento\Framework\App\Action\Forward;
use Magento\Framework\App\ActionFactory;
use Magento\Framework\App\ActionInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\App\RouterInterface;
use Slark\StoreLocator\Api\Data\StoreLocatorInterfaceFactory;
use Slark\StoreLocator\Api\StoreLocatorRepositoryInterface as StoreLocatorRepository;
use Slark\StoreLocator\Model\ResourceModel\StoreLocator;
use Slark\StoreLocator\Model\VerificationUrl;

/**
 * @property ActionFactory $actionFactory
 * @property StoreLocatorRepository $storeRepository
 * @property VerificationUrl $url
 */
class Router implements RouterInterface
{
    /**
     * @param ActionFactory $actionFactory
     * @param StoreLocatorRepository $storeRepository
     * @param VerificationUrl $url
     */
    public function __construct(
        ActionFactory $actionFactory,
        StoreLocatorRepository $storeRepository,
        VerificationUrl $url
    ) {
        $this->actionFactory = $actionFactory;
        $this->storeRepository = $storeRepository;
        $this->url = $url;
    }

    /**
     * @param RequestInterface $request
     * @return ActionInterface|null
     */
    public function match(RequestInterface $request)
    {
        $urlKey = trim($request->getPathInfo(), '/');
        $url = explode('/', $urlKey);

        if (str_contains($urlKey, 'stores')) {
            $request->setModuleName('stores');
            $request->setControllerName('store');
            $request->setActionName('index');
            if (isset($url[1])) {
                $storeUrl = $this->url->checkUrlKeys($url[1]);
                if ($storeUrl) {
                    $store = $this->storeRepository->getById((int)$storeUrl);
                    $request->setParams([
                        'store' => $store
                    ]);
                    return $this->actionFactory->create(Forward::class);
                }
            }
        }
        return $this->actionFactory->create(Forward::class);

        return null;
    }


}
