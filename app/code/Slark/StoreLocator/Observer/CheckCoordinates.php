<?php

namespace Slark\StoreLocator\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Slark\StoreLocator\Model\GuzzleCode;

class CheckCoordinates implements ObserverInterface
{
    public function __construct(GuzzleCode $locator)
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
        $storeLocator = $observer->getData('object');
        $data = $storeLocator->getData();
        $coordinates =[];
      //  print_r($coordinates);

        if (!empty($data['longitude']) && !empty($data['latitude'])) {
            return $storeLocator;
        } elseif (empty($data['longitude']) or empty($data['latitude'])) {
            $coordinates = $this->locator->getCord($storeLocator->getAddres());
            $storeLocator->setLati((string)$coordinates['lat']);
            $storeLocator->setLongi((string)$coordinates['lng']);
        }
       // return $storeLocator;
    }
}
