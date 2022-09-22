<?php

namespace Slark\StoreLocator\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Slark\StoreLocator\Model\ResourceModel\StoreLocator\Collection;
use Slark\StoreLocator\Model\VerificationUrl;

class UrlRewrite implements ObserverInterface
{
    /**
     * @param VerificationUrl $url
     */
    public function __construct(
        VerificationUrl $url,
        Collection $collection
    ) {
        $this->url = $url;
        $this->collection = $collection;
    }

    /**
     * @param Observer $observer
     * @return void
     * @throws \Exception
     */
    public function execute(Observer $observer)
    {
        $storeLocator = $observer->getData('object');
        if (empty($storeLocator['url_key'])) {
            $this->autoUrl($storeLocator);
        } else {
            //$this->url->checkUniqueUrl($storeLocator['url_key']);
            if ($this->url->checkUniqueUrl($storeLocator['url_key'])==false) {
                $this->autoUrl($storeLocator);
            } else {
                return $storeLocator;
            }
        }
    }

    /**
     * @param $storeLocator
     * @return void
     * @throws \Exception
     */


    public function autoUrl($storeLocator):void
    {
        //$name = $this->collection->load()->getData();
        $check = [" ","$",".","&","?"];
        $name = str_replace($check, '-', strtolower($storeLocator['store_name']));
        $autoUrl = $name . '-route' ;
        if ($this->url->newUrl($storeLocator['url_key'], $autoUrl)==false) {
            $newAutoUrl = $name . '-route' . random_int(1, 255);
            $storeLocator->setUrl($newAutoUrl);
        } else {
            $storeLocator->setUrl($autoUrl);
        }
        //$storeLocator->setUrl($autoUrl);
    }
}
