<?php

namespace Skark\StoreLocator\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;

class CustomSaveAfter implements ObserverInterface
{
    public function execute(Observer $observer)
    {
        try {
            // Get the model object from observer
            $model = $observer->getEvent()->getDataObject();

            if ($model && $model->isObjectNew()) {
                // perform some action if new model
            } else {
                // perform some action if edit model
            }
        } catch (\Exception $e) {
        }
    }
}
