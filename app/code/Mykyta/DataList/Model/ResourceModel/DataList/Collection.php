<?php

namespace Mykyta\DataList\Model\ResourceModel\DataList;

use Mykyta\DataList\Model\DataList;
use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Mykyta\DataList\Model\ResourceModel\DataList as DataListResource;

class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_idFieldName = 'entity_id';

    protected function _construct()
    {
        $this->_init(DataList::class, DataListResource::class);
    }

}
