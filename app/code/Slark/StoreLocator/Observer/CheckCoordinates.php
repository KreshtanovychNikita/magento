<?php

namespace Skark\StoreLocator\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Slark\StoreLocator\Api\LocatorInterface;

class CheckCoordinates implements ObserverInterface
{
    private LocatorInterface $locator;
    public function __construct(LocatorInterface $locator)
    {
        $this->locator = $locator;
    }

    /**
     * @param Observer $observer
     * @return array|mixed|void|null
     * @throws \JsonException
     */
    public function execute(Observer $observer)
    {
        $storeLocator = $observer->getData('storeLocator');
        $data = $storeLocator->getData();

        if (!empty($data['longitude']) && !empty($data['latitude'])) {
            return $storeLocator;
        } elseif (empty($data['longitude']) or empty($data['latitude'])) {
            $coordinates = $this->locator->getCord($storeLocator->getAddres());
        }
        $storeLocator->setLati((string)$coordinates[1]);
        $storeLocator->setLongi((string)$coordinates[0]);
        return $storeLocator;
    }
}
