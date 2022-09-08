<?php

namespace Slark\StoreLocator\UI\DataProvider\StoreLocator;

use Slark\StoreLocator\Model\ResourceModel\StoreLocator\CollectionFactory;
use Magento\Ui\DataProvider\AbstractDataProvider;
use Slark\StoreLocator\Model\ResourceModel\StoreLocator\Collection;


class ListingDataProvider extends AbstractDataProvider
{
    private CollectionFactory $collectionFactory;
    //protected Collection $collection;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collectionFactory = $collectionFactory;
        $this->collection = $collectionFactory->create();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
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
