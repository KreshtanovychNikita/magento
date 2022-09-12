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

    public function setName(string $name): StoreLocatorInterface
    {
        $this->setData(self::NAME, $name);
        return $this;
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

    public function setAddres(string $addres): StoreLocatorInterface
    {
        $this->setData(self::ADDRES, $addres);
        return $this;
    }
    public function getWork(): string
    {
        return $this->getData(StoreLocatorInterface::WORK);
    }

    public function setWork(string $work): StoreLocatorInterface
    {
        $this->setData(StoreLocatorInterface::WORK, $work);
        return $this;
    }
    public function getLati(): string
    {
        return $this->getData(StoreLocatorInterface::LATI);
    }

    public function setLati(string $lati):StoreLocatorInterface
    {
        $this->setData(self::LATI, $lati);
        return $this;
    }
    public function getLongi(): string
    {
        return $this->getData(StoreLocatorInterface::LONGI);
    }

    public function setLongi(string $longi):StoreLocatorInterface
    {
        $this->setData(self::LONGI, $longi);
        return $this;
    }
    public function getDesc(): string
    {
        return $this->getData(StoreLocatorInterface::DESC);
    }

    public function setDesc(string $desc):StoreLocatorInterface
    {
        $this->setData(self::DESC, $desc);
        return $this;
    }

    public function getImage(): string
    {
        return $this->getData(StoreLocatorInterface::IMAGE);
    }

    public function setImage(string $image):StoreLocatorInterface
    {
        $this->setData(self::IMAGE, $image);
        return $this;
    }
    public function getUrl(): string
    {
        return $this->getUrl(StoreLocatorInterface::URL);
    }
    public function setUrl(string $url): StoreLocatorInterface
    {
        $this->setData(self::URL, $url);
        return $this;
    }
}
