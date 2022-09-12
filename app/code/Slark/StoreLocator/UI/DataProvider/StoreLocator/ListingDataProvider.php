<?php

namespace Slark\StoreLocator\UI\DataProvider\StoreLocator;

class ListingDataProvider extends \Magento\Framework\View\Element\UiComponent\DataProvider\DataProvider
{
    private \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $storeLocatorCollectionFactory;
    private array $loadedData = [];

    public function __construct(
        \Magento\Backend\Model\UrlInterface $urlBuilder,
        // @TODO: use repository or not?
        \Magento\Catalog\Model\ResourceModel\Product\CollectionFactory $storeLocatorCollectionFactory,
        string $name,
        string $primaryFieldName,
        string $requestFieldName,
        \Magento\Framework\Api\Search\ReportingInterface $reporting,
        \Magento\Framework\Api\Search\SearchCriteriaBuilder $searchCriteriaBuilder,
        \Magento\Framework\App\RequestInterface $request,
        \Magento\Framework\Api\FilterBuilder $filterBuilder,
        array $meta = [],
        array $data = []
    ) {
        parent::__construct(
            $name,
            $primaryFieldName,
            $requestFieldName,
            $reporting,
            $searchCriteriaBuilder,
            $request,
            $filterBuilder,
            $meta,
            $data
        );
        $this->urlBuilder = $urlBuilder;
        $this->storeLocatorCollectionFactory = $storeLocatorCollectionFactory;
    }

    public function getData() : array
    {
        if (!$this->getCollection()->isLoaded()) {
            $this->getCollection()->load();
        }
        $items = $this->getCollection()->toArray();

        return $items;

    }
}
