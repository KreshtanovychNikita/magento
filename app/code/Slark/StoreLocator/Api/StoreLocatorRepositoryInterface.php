<?php

namespace Slark\StoreLocator\Api;

use Magento\Framework\Api\SearchCriteriaInterface;
use Slark\StoreLocator\Api\Data\StoreLocatorInterface;

interface StoreLocatorRepositoryInterface
{
    /**
     * @param int $id
     * @return StoreLocatorInterface
     */
    //public function save(StoreLocatorInterface $store): StoreLocatorInterface;

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
    /**
     * @param StoreLocatorInterface $store_id
     * @return StoreLocatorInterface
     */
    public function getById(int $store_id): StoreLocatorSearchResultInterface;


//    public function deleteById(int $store_id): StoreLocatorSearchResultInterface;
}
