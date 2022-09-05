<?php

namespace Slark\StoreLocator\UI\Component\Control\StoreLocator;

use Slark\StoreLocator\Model\StoreLocatorRepository;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\UrlInterface;
use phpDocumentor\Reflection\Utils;

class GenericButton
{
    private UrlInterface $urlBuilder;
    private RequestInterface $request;
    private StoreLocatorRepository $storeLocatorRepository;

    public function __construct(
        UrlInterface $urlBuilder,
        RequestInterface $request,
        StoreLocatorRepository $storeLocatorRepository
    ) {
        $this->urlBuilder = $urlBuilder;
        $this->request = $request;
        $this->storeLocatorRepository = $storeLocatorRepository;
    }

    public function getUrl($route = '', $params = [])
    {
        return $this->urlBuilder->getUrl($route, $params);
    }

    public function getStoreLocator()
    {
        $storeLocatorId = $this->request->getParam('id');
        if ($storeLocatorId === null) {
            return 0;
        }
        $storeLocatorId = $this->storeLocatorRepository->get($storeLocatorId);

        return $storeLocatorId->getId() ?: null;
    }
}
