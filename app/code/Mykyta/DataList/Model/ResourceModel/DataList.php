<?php

namespace Mykyta\DataList\Model\ResourceModel;

use Mykyta\DataList\Api\Data\DataListInterface;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use Magento\Framework\Model\ResourceModel\Db\Context;

class DataList extends AbstractDb
{
    public const TABLE_NAME = 'mykyta_data_list';

    public function __construct(
        Context $context
    ) {
        parent::__construct($context);
    }

    protected function _construct()
    {
        $this->_init(self::TABLE_NAME, DataListInterface::ID);
    }
}
