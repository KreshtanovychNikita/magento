<?php

namespace Slark\StoreLocator\Model\ResourceModel\StoreLocator;

use Slark\StoreLocator\Model\StoreLocator;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Slark\StoreLocator\Model\ResourceModel\StoreLocator as StoreLocatorResource;

class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'store_id';

    protected function _construct()
    {
        $this->_init(StoreLocator::class, StoreLocatorResource::class);
    }

}
