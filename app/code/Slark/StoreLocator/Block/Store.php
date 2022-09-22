<?php
//declare(strict_types=1);

namespace Slark\StoreLocator\Block;

//use Magento\Tests\NamingConvention\true\string;
use Slark\StoreLocator\Model\ResourceModel\StoreLocator\Collection;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\View\Element\Template;
use Magento\Backend\Block\Template\Context;
use Slark\StoreLocator\Model\ResourceModel\StoreLocator\CollectionFactory;
use Magento\Store\Model\StoreManagerInterface;

class Store extends Template
{
    private StoreManagerInterface $storeManager;

    /**
     * @param Context $context
     * @param StoreManagerInterface $storeManager
     * @param array $data
     */
    public function __construct(
        Context $context,
        StoreManagerInterface $storeManager,
        array $data = []
    ) {
        $this->storeManager= $storeManager;
        parent::__construct($context, $data);
    }
    /**
     * @return mixed|null
     */
    public function getStore()
    {
        $store = $this->getRequest()->getParams();
        if ($store === null) {
            return null;
        }
        return $store['store'];
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
