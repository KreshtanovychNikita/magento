<?php

namespace Slark\StoreLocator\Api;

use Slark\StoreLocator\Api\Data\StoreLocatorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;

interface StoreLocatorRepositoryInterface
{
    /**
     * @param int $id
     * @return StoreLocatorInterface
     */
    public function get(int $id): StoreLocatorInterface;

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return StoreLocatorSearchResultInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria): StoreLocatorSearchResultInterface;

    /**
     * @param StoreLocatorInterface $storeLocator
     * @return StoreLocatorInterface
     */
    public function save(StoreLocatorInterface $storeLocator): StoreLocatorInterface;

    /**
     * @param StoreLocatorInterface $workingHours
     * @return bool
     */
    public function delete(StoreLocatorInterface $workingHours): bool;
}
