<?php

declare(strict_types=1);

namespace Slark\StoreLocator\Ui\DataProvider\StoreLocator;

use Slark\StoreLocator\Model\ResourceModel\StoreLocator\CollectionFactory as StoreLocatorCollectionFactory;

class FormDataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /**
     * DiscountFormDataProvider constructor.
     * @param StoreLocatorCollectionFactory $storeLocatorCollectionFactory
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        StoreLocatorCollectionFactory $storeLocatorCollectionFactory,
        string $name,
        string $primaryFieldName,
        string $requestFieldName,
        array $meta = [],
        array $data = []
    ) {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->collection = $storeLocatorCollectionFactory->create();
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData(): array
    {
        $data = [];

        foreach (parent::getData()['items'] as $item) {
            $data[$item['store_id']] = $item;
        }

        return $data;
    }
}
