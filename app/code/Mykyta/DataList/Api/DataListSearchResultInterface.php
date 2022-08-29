<?php

namespace Mykyta\DataLIst\Api;

use Magento\Framework\Data\SearchResultInterface;
use Mykyta\DataList\Api\Data\DataListInterface;

interface DataListSearchResultInterface extends SearchResultInterface
{
    /**
     * @return DataListInterface[]
     */
    public function getItems();

    /**
     * @param DataLIstInterface[]
     * @return void
     */
    public function setItems(array $items);
}
