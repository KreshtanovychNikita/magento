<?php

namespace Mykyta\DataList\Model;

use Mykyta\DataList\Api\Data\DataListInterface;
use Mykyta\DataList\Api\DataListRepositoryInterface;
use Mykyta\DataList\Api\DataListSearchResultInterface;
use Mykyta\DataList\Model\ResourceModel\DataList\CollectionFactory;
use Mykyta\DataList\Model\ResourceModel\DataList as DataListResource;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Api\SearchCriteriaInterface;
use Mykyta\DataList\Api\DataListSearchResultInterfaceFactory;
use Mykyta\DataList\Model\DataListFactory;

class DataListRepository implements DataListRepositoryInterface
{
    private CollectionFactory $collectionFactory;
    private DataListResource $dataListResource;
    private DataListFactory $dataListFactory;
    private DataListSearchResultInterfaceFactory $searchResultInterfaceFactory;

    /**
     * @param DataListFactory $dataListFactory
     * @param CollectionFactory $collectionFactory
     * @param DataListResource $datalistResource
     * @param DataListSearchResultInterfaceFactory $searchResultInterfaceFactory
     */
    public function __construct(
        DataListFactory $dataListFactory,
        CollectionFactory $collectionFactory,
        DataListResource  $dataListResource,
        DataListSearchResultInterfaceFactory $searchResultInterfaceFactory
    ) {
        $this->dataListFactory = $dataListFactory;
        $this->collectionFactory = $collectionFactory;
        $this->dataListResource = $dataListResource;
        $this->searchResultFactory = $searchResultInterfaceFactory;
    }

    /**
     * @param int $id
     * @return DataListInterface
     * @throws NoSuchEntityException
     */
    public function get(int $id): DataListInterface
    {
        $object = $this->dataListFactory->create();
        $this->dataListResource->load($object, $id);
        if (! $object->getId()) {
            throw new NoSuchEntityException(__('Unable to find entity with ID "%1"', $id));
        }
        return $object;
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return DataListSearchResultInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria): DataListSearchResultInterface
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
     * @param DataListInterface $dataList
     * @return DataListInterface
     * @throws \Magento\Framework\Exception\AlreadyExistsException
     */
    public function save(DataListInterface $dataList): DataListInterface
    {
        $this->dataListResource->save($dataList);
        return $dataList;
    }

    /**
     * @param DataListInterface $workingHours
     * @return bool
     */
    public function delete(DataListInterface $workingHours): bool
    {
        try {
            $this->dataListResource->delete($workingHours);
        } catch (\Exception $e) {
            throw new StateException(__('Unable to remove entity #%1', $workingHours->getId()));
        }
        return true;
    }
}
