<?php

namespace Slark\StoreLocator\Model;

use Magento\Framework\Model\AbstractModel;
use Slark\StoreLocator\Api\Data\StoreLocatorInterface;

class StoreLocator extends AbstractModel implements StoreLocatorInterface
{
    protected $_eventPrefix = "store_locator";
    //store_locator_save_before
    //store_locator_save_after
    //store_locator_load_before
    //store_locator_load_after

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

    public function getId():?int
    {
        return $this->getData(StoreLocatorInterface::ID);
    }

    public function setId($value): StoreLocatorInterface
    {
        $this->setData('store_id', $value);
        return $this;
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

    public function getImage(): ?string
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
        return $this->getData(StoreLocatorInterface::URL);
    }
    public function setUrl(string $url): StoreLocatorInterface
    {
        $this->setData(self::URL, $url);
        return $this;
    }
}
