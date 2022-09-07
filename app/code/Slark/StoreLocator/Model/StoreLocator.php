<?php

namespace Slark\StoreLocator\Model;

use Magento\Framework\Model\AbstractModel;
use Slark\StoreLocator\Api\Data\StoreLocatorInterface;

class StoreLocator extends AbstractModel implements StoreLocatorInterface
{
    protected function _construct()
    {
        parent::_init('Slark\StoreLocator\Model\ResourceModel\StoreLocator');
    }

    public function getName(): string
    {
        return $this->getData(StoreLocatorInterface::NAME);
    }

    public function setName(string $name): void
    {
        $this->setData(StoreLocatorInterface::NAME, $name);
    }

    public function getId()
    {
        return $this->_getData('store_id');
    }

    public function setId($value)
    {
        $this->setData('store_id', $value);
    }

    public function getAddres(): string
    {
        return $this->getData(StoreLocatorInterface::ADDRES);
    }

    public function setAddres(string $addres): void
    {
        $this->setData(StoreLocatorInterface::ADDRES, $addres);
    }
    public function getWork(): string
    {
        return $this->getData(StoreLocatorInterface::WORK);
    }

    public function setWork(string $work): void
    {
        $this->setData(StoreLocatorInterface::WORK, $work);
    }
    public function getLati(): string
    {
        return $this->getData(StoreLocatorInterface::LATI);
    }

    public function setLati(string $lati): void
    {
        $this->setData(StoreLocatorInterface::LATI, $lati);
    }
    public function getLongi(): string
    {
        return $this->getData(StoreLocatorInterface::LONGI);
    }

    public function setLongi(string $longi): void
    {
        $this->setData(StoreLocatorInterface::LONGI, $longi);
    }
    public function getDesc(): string
    {
        return $this->getData(StoreLocatorInterface::DESC);
    }

    public function setDesc(string $desc): void
    {
        $this->setData(StoreLocatorInterface::DESC, $desc);
    }

    public function getImage(): string
    {
        return $this->getData(StoreLocatorInterface::IMAGE);
    }

    public function setImage( string $image): void
    {
        $this->setData(StoreLocatorInterface::IMAGE, $image);
    }

}
