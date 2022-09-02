<?php

namespace Mykyta\DataList\UI\DataProvider\DataList;

use Mykyta\DataList\Model\ResourceModel\DataList\CollectionFactory;
use Magento\Ui\DataProvider\AbstractDataProvider;


class EditDataProvider extends AbstractDataProvider
{
    public function __construct(
        $name, $primaryFieldName,
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

    public function getDataSourseData(){
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
