<?php

namespace Slark\StoreLocator\Model;

use Laminas\EventManager\EventManager;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Slark\StoreLocator\Api\Data\StoreLocatorInterface;
use Slark\StoreLocator\Api\StoreLocatorRepositoryInterface;
use Slark\StoreLocator\Api\StoreLocatorSearchResultInterface;
use Slark\StoreLocator\Api\StoreLocatorSearchResultInterfaceFactory;
use Slark\StoreLocator\Model\ResourceModel\StoreLocator as StoreLocatorResource;
use Slark\StoreLocator\Model\ResourceModel\StoreLocator\CollectionFactory;

class StoreLocatorRepository implements StoreLocatorRepositoryInterface
{
    private CollectionFactory $collectionFactory;
    private StoreLocatorResource $storeLocatorResource;
    private StoreLocatorFactory $storeLocatorFactory;
    private StoreLocatorSearchResultInterfaceFactory $searchResultInterfaceFactory;
    private EventManager $eventManager;

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
        StoreLocatorSearchResultInterfaceFactory $searchResultInterfaceFactory,
        EventManager $eventManager

    ) {
        $this->storeLocatorFactory = $storeLocatorFactory;
        $this->collectionFactory = $collectionFactory;
        $this->storeLocatorResource = $storeLocatorResource;
        $this->searchResultFactory = $searchResultInterfaceFactory;
        $this->eventManager = $eventManager;
    }

    /**
     * @param int $id
     * @return StoreLocatorInterface
     * @throws NoSuchEntityException
     */
    public function get($id): StoreLocatorInterface
    {
        $object = $this->storeLocatorFactory->create();
        $this->storeLocatorResource->load($object, $id);
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
        //$this->eventManager->eventPrefix('slark_storelocator_save', ['storeLocator' => $storeLocator]);
        $this->storeLocatorResource->save($storeLocator);
        return $storeLocator;
    }

    /**
     * @param StoreLocatorInterface $workingHours
     * @return bool
     */
    public function delete(StoreLocatorInterface $workingHours): bool
    {
        try {
            $this->storeLocatorResource->delete($workingHours);
        } catch (\Exception $e) {
            throw new StateException(__('Unable to remove entity #%1', $workingHours->getId()));
        }
        return true;
    }

    public function getById(int $store_id): StoreLocatorInterface
    {
        $locator = $this->storeLocatorFactory->create();
        $this->storeLocatorResource->load($locator, $store_id);
        return $locator;
    }
    /**
     * @param int $id
     * @return bool
     */
    public function deleteById(int $id)
    {
        return $this->delete($this->get($id));
    }
}
