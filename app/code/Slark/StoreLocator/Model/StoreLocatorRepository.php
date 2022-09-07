<?php

namespace Slark\StoreLocator\Model;

use Slark\StoreLocator\Api\Data\StoreLocatorInterface;
use Slark\StoreLocator\Api\StoreLocatorRepositoryInterface;
use Slark\StoreLocator\Api\StoreLocatorSearchResultInterface;
use Slark\StoreLocator\Model\ResourceModel\StoreLocator\CollectionFactory;
use Slark\StoreLocator\Model\ResourceModel\StoreLocator as StoreLocatorResource;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Api\SearchCriteriaInterface;
use Slark\StoreLocator\Api\StoreLocatorSearchResultInterfaceFactory;
use Slark\StoreLocator\Model\StoreLocatorFactory;

class StoreLocatorRepository implements StoreLocatorRepositoryInterface
{
    private CollectionFactory $collectionFactory;
    private StoreLocatorResource $storeLocatorResource;
    private StoreLocatorFactory $storeLocatorFactory;
    private StoreLocatorSearchResultInterfaceFactory $searchResultInterfaceFactory;

    /**
     * @param StoreLocatorFactory $storeLocatorFactory
     * @param CollectionFactory $collectionFactory
     * @param StoreLocatorResource $storeLocatorResource
     * @param StoreLocatorSearchResultInterfaceFactory $searchResultInterfaceFactory
     */
    public function __construct(
        StoreLocatorFactory $storeLocatorFactory,
        CollectionFactory $collectionFactory,
        StoreLocatorResource  $storeLocatorResource,
        StoreLocatorSearchResultInterfaceFactory $searchResultInterfaceFactory
    ) {
        $this->StoreLocatorFactory = $storeLocatorFactory;
        $this->collectionFactory = $collectionFactory;
        $this->StoreLocatorResource = $storeLocatorResource;
        $this->searchResultFactory = $searchResultInterfaceFactory;
    }

    /**
     * @param int $id
     * @return StoreLocatorInterface
     * @throws NoSuchEntityException
     */
    public function get(int $id): StoreLocatorInterface
    {
        $object = $this->StoreLocatorFactory->create();
        $this->StoreLocatorResource->load($object, $id);
        if (! $object->getId()) {
            throw new NoSuchEntityException(__('Unable to find entity with ID "%1"', $id));
        }
        return $object;
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return StoreLocatorSearchResultInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria): StoreLocatorSearchResultInterface
    {
        $collection = $this->collectionFactory->create();
        foreach ($searchCriteria->getFilterGroups() as $filterGroup) {
            foreach ($filterGroup->getFilters() as $filter) {
                $condition = $filter->getConditionType() ? $filter->getConditionType() : 'eq';
                $collection->addFieldToFilter($filter->getField(), [$condition => $filter->getValue()]);
            }
        }

        $searchResult = $this->searchResultFactory->create();
        $searchResult->setSearchCriteria($searchCriteria);
        $searchResult->setItems($collection->getItems());
        $searchResult->setTotalCount($collection->getSize());
        return $searchResult;
    }

    /**
     * @param StoreLocatorInterface $storeLocator
     * @return StoreLocatorInterface
     * @throws \Magento\Framework\Exception\AlreadyExistsException
     */
    public function save(StoreLocatorInterface $storeLocator): StoreLocatorInterface
    {
        $this->StoreLocatorResource->save($storeLocator);
        return $storeLocator;
    }

    /**
     * @param StoreLocatorInterface $workingHours
     * @return bool
     */
    public function delete(StoreLocatorInterface $workingHours): bool
    {
        try {
            $this->StoreLocatorResource->delete($workingHours);
        } catch (\Exception $e) {
            throw new StateException(__('Unable to remove entity #%1', $workingHours->getId()));
        }
        return true;
    }
}
