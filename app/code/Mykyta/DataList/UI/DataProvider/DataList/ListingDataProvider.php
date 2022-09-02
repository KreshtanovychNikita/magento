<?php

namespace Mykyta\DataList\UI\DataProvider\DataList;

use Mykyta\DataList\Model\ResourceModel\DataList\CollectionFactory;
use Magento\Ui\DataProvider\AbstractDataProvider;


class ListingDataProvider extends AbstractDataProvider
{
    private CollectionFactory $collectionFactory;

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

    public function getData()
    {
        if (!$this->getCollection()->isLoaded()) {
            $this->getCollection()->load();
        }
        $items = $this->getCollection()->toArray();

        return $items;
    }
}
