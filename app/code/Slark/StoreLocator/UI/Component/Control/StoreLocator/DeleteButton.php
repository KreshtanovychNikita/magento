<?php

namespace Slark\StoreLocator\UI\Component\Control\StoreLocator;

use Slark\StoreLocator\UI\Component\Control\StoreLocator\GenericButton;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class DeleteButton extends GenericButton implements ButtonProviderInterface
{

    public function getButtonData()
    {
        if ($this->getStoreLocator()) {
            return [
                'id' => 'delete',
                'label' => __('Delete'),
                'on_click' => "deleteConfirm('" .__('Are you sure you want to delete this product type?') ."', '"
                    . $this->getUrl('*/*/delete', ['id' => $this->getStoreLocator()]) . "', {data: {}})",
                'class' => 'delete',
                'sort_order' => 10
            ];
        }
        return [];
    }
}
