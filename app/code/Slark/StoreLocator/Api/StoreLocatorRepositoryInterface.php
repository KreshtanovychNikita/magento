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
//    public function save(StoreLocatorInterface $storeLocator): StoreLocatorInterface;
//
//    /**
//     * @param StoreLocatorInterface $workingHours
//     * @return bool
//     */
//    public function delete(StoreLocatorInterface $workingHours): bool;
//    /**
//     * @param StoreLocatorInterface $store_id
//     * @return StoreLocatorInterface
//     */
//    public function getById(int $store_id): StoreLocatorSearchResultInterface;
//
//    /**
//     * Create attribute set from data
//     *
//     * @param \Magento\Eav\Api\Data\AttributeSetInterface $attributeSet
//     * @param int $skeletonId
//     * @return \Magento\Eav\Api\Data\AttributeSetInterface
//     * @throws \Magento\Framework\Exception\InputException
//     * @throws \Magento\Framework\Exception\NoSuchEntityException
//     */
//    public function create(\Magento\Eav\Api\Data\AttributeSetInterface $attributeSet, $skeletonId);
//
//    /**
//     * @param int $store_id
//     * @return void
//     */
//    public function deleteById(int $store_id): void;
}
