<?php
namespace Slark\StoreLocator\Ui\DataProvider\StoreLocator;

use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\UrlInterface;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Ui\DataProvider\AbstractDataProvider;
use Slark\StoreLocator\Model\ResourceModel\StoreLocator\Collection;
use Slark\StoreLocator\Model\ResourceModel\StoreLocator\CollectionFactory as StoreLocatorCollectionFactory;

class FormDataProvider extends AbstractDataProvider
{
    /**
     * @var StoreManagerInterface $storeManager
     */
    protected StoreManagerInterface $storeManager;

    /**
     * @var array $loadedData
     */
    protected array $loadedData;
    /**
     * @var Collection $collection
     */
    protected $collection;
    /**
     *  @param StoreManagerInterface $storeManager
     * @param StoreLocatorCollectionFactory $storeLocatorCollectionFactory
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        StoreLocatorCollectionFactory $storeLocatorCollectionFactory,
        string $name,
        string $primaryFieldName,
        string $requestFieldName,
        array $meta = [],
        array $data = [],
        StoreManagerInterface $storeManager
    ) {
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
        $this->collection = $storeLocatorCollectionFactory->create();
        $this->storeManager = $storeManager;
    }

    /**
     * Get data
     *
     * @return array
     */
//    public function getData(): array
//    {
//        $data = [];
//
//        foreach (parent::getData()['items'] as $item) {
//            $data[$item['store_id']] = $item;
//        }
//
//        return $data;
//    }
    /**
     * Get data
     *
     * @return array
     * @throws NoSuchEntityException
     */
    public function getData(): array
    {
        $baseurl =  $this->storeManager->getStore()->getBaseUrl(UrlInterface::URL_TYPE_MEDIA);
        $this->loadedData = [];
        if (!empty($this->loadedData)) {
            return $this->loadedData;
        }
        $items = $this->collection->getItems();
        foreach ($items as $store) {
            $temp = $store->getData();
            $img = [];
            $img[0]['name'] = $temp['image'];
            $img[0]['url'] = $baseurl . 'store/image/' . $temp['image'];
            $temp['image'] = $img;
            $this->loadedData[$store->getId()] = array_merge($store->getData(), $temp);
        }
        return $this->loadedData;
    }
}
