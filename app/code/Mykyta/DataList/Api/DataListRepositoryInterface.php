<?php

namespace Mykyta\DataList\Api;

use Mykyta\DataList\Api\Data\DataListInterface;
use Magento\Framework\Api\SearchCriteriaInterface;

interface DataListRepositoryInterface
{
    /**
     * @param int $id
     * @return DataListInterface
     */
    public function get(int $id): DataListInterface;

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return DataListSearchResultInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria): DataListSearchResultInterface;

    /**
     * @param DataListInterface $dataList
     * @return DataListInterface
     */
    public function save(DataListInterface $dataList): DataListInterface;

    /**
     * @param DataListInterface $workingHours
     * @return bool
     */
    public function delete(DataListInterface $workingHours): bool;
}
