<?php

namespace Slark\StoreLocator\Api;

use Magento\Framework\Data\SearchResultInterface;
use Slark\StoreLocator\Api\Data\StoreLocatorInterface;

interface StoreLocatorSearchResultInterface extends SearchResultInterface
{
    /**
     * @return StoreLocatorInterface[]
     */
    public function getItems();

    /**
     * @param StoreLocatorInterface[]
     * @return void
     */
    public function setItems(array $items);
}
