<?php

namespace Slark\StoreLocator\UI\DataProvider\StoreLocator;

use Magento\Ui\DataProvider\AbstractDataProvider;
use Slark\StoreLocator\Model\ResourceModel\StoreLocator\CollectionFactory;

class EditDataProvider extends AbstractDataProvider
{
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $collectionFactory->create();
        parent::__construct(
            $name,
            $primaryFieldName,
            $requestFieldName,
            $meta,
            $data
        );
    }

    public function getDataSourseData(): array
    {
        return [];
    }

    public function getData()
    {
        return parent::getData();
    }

    /**
     * @return array
     */
    public function getMeta(): array
    {
        return $this->meta;
    }
}
