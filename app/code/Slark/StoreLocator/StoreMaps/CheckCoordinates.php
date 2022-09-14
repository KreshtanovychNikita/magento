<?php

namespace Skark\StoreLocator\StoreMaps;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;

class CheckCoordinates implements ObserverInterface
{
    private ObserverInterface $observer;
    private $location;

    public function __construct(ObserverInterface $observer)
    {
        $this->observer = $observer;
    }

    public function execute(Observer $observer)
    {
        $locate = $observer->getData('locate');
        $data = $locate->getData();
        $cord = $this->location->getCord($data['address']);
        //$locate = setLongi($cord['longi']);
        //$locate = setLati($cord['lati']);
    }
}
