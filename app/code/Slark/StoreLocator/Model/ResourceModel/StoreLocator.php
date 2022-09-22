<?php

namespace Slark\StoreLocator\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Magento\Framework\Model\ResourceModel\Db\Context;
use Slark\StoreLocator\Api\Data\StoreLocatorInterface;

class StoreLocator extends AbstractDb
{
    public const TABLE_NAME = 'slark_store_locator';

    public function __construct(
        Context $context
    ) {
        parent::__construct($context);
    }

    protected function _construct()
    {
        $this->_init(self::TABLE_NAME, StoreLocatorInterface::ID);
    }
}
