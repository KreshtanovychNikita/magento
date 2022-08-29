<?php

namespace Mykyta\DataList\Model;
use Mykyta\DataList\Api\Data\DataListInterface;
use Magento\Framework\Model\AbstractModel;

class DataList extends AbstractModel implements DataListInterface

{

    protected function _construct()
    {
        parent::_init('Mykyta\DataList\Model\ResourceModel\DataList');
    }

    public function getType(): string
    {
        return $this->getData(DataListInterface::TYPE);
    }

    public function setType(string $type): void
    {
        $this->setData(DataListInterface::TYPE, $type);
    }

    public function getId()
    {
        return $this->_getData('entity_id');
    }

    public function setId($value)
    {
        return $this->setData('entity_id', $value);
    }


}
