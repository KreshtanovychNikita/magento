<?php

namespace Slark\StoreLocator\Block;

use Magento\Backend\Block\Template\Context;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\View\Element\Template;
use Magento\Store\Model\StoreManagerInterface;
use Slark\StoreLocator\Model\ResourceModel\StoreLocator\Collection;
use Slark\StoreLocator\Model\ResourceModel\StoreLocator\CollectionFactory;

class Index extends Template
{
    /**
     * @param Context $context
     * @param CollectionFactory $collectionFactory
     * @param StoreManagerInterface $storeManager
     * @param array $data
     */
    public function __construct(
        Context $context,
        CollectionFactory
                $collectionFactory,
        StoreManagerInterface $storeManager,
        array $data = []
    ) {
        $this->collection = $collectionFactory;
        $this->storeManager= $storeManager;
        parent::__construct($context, $data);
    }

    /**
     * @return Collection
     */
    public function getCollection():Collection
    {
        return $this->collection->create();
    }

    /**
     * @return string
     * @throws NoSuchEntityException
     */
    public function getMediaUrl():string
    {
        $mediaUrl = $this->storeManager->getStore()
            ->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);

        return $mediaUrl;
    }

}
