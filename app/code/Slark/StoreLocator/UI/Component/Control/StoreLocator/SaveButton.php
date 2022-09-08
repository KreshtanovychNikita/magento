<?php

namespace Slark\StoreLocator\UI\Component\Control\StoreLocator;

use Slark\StoreLocator\UI\Component\Control\StoreLocator\GenericButton;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

class SaveButton extends GenericButton implements ButtonProviderInterface
{
    public function getButtonData()
    {
        return [
            'label' => __('Save Data Info'),
            'class' => 'save primary',
            'data_attribute' => [
                'mage-init' => [
                    'buttonAdapter' => [
                        'actions' => [
                            [
                                'targetName' => 'store_locator_form.store_locator_form',
                                'actionName' => 'save',
                                'params' => [
                                    true,
                                    [
                                        'back' => 'continue'
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ],
//            'data_attribute' => [
//                'mage-init' => ['button' => ['event' => 'save']],
//                'form-role' => 'save',
//            ],
            'sort_order' => 20,
        ];
    }
}
