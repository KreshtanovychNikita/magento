<?php

namespace Slark\StoreLocator\Controller\Adminhtml\StoreLocator;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Catalog\Model\ImageUploader;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Controller\Result\RedirectFactory;
use Magento\Framework\Exception\AlreadyExistsException;
use Magento\Framework\Exception\LocalizedException;
use Slark\StoreLocator\Api\Data\StoreLocatorInterface;
use Slark\StoreLocator\Api\StoreLocatorRepositoryInterface;
use Slark\StoreLocator\Model\StoreLocatorFactory;
use Slark\StoreLocator\Model\StoreLocatorRepository;

class Save extends Action implements HttpPostActionInterface
{
    private StoreLocatorRepositoryInterface $storeLocatorRepository;
    private StoreLocatorFactory $storeLocatorFactory;
    private RedirectFactory $redirectFactory;
    private ImageUploader $imageUploader;

    public function __construct(
        Context $context,
        StoreLocatorRepository $storeLocatorRepository,
        StoreLocatorFactory $storeLocatorFactory,
        ImageUploader       $imageUploader,
        RedirectFactory     $redirectFactory
    ) {
        parent::__construct($context);
        $this->imageUploader = $imageUploader;
        $this->storeLocatorRepository = $storeLocatorRepository;
        $this->storeLocatorFactory = $storeLocatorFactory;
        $this->redirectFactory = $redirectFactory;
        $this->imageUploader->setBasePath('storelocator/image');
        $this->imageUploader->setBaseTmpPath('storelocator/tmp/image');
        parent::__construct($context);
    }

    /**
     * @throws AlreadyExistsException
     * @throws LocalizedException
     */
    public function execute()
    {
        $redirectResult = $this->redirectFactory->create();
        $storeLocator= $this->storeLocatorFactory->create();
        $data = $this->getRequest()->getPostValue();
//        $storeLocator->setName($data['store_name'][StoreLocatorInterface::NAME]);
//        $storeLocator->setId($data['store_id'][StoreLocatorInterface::ID]);
//        $storeLocator->setDesc($data['store_description'][StoreLocatorInterface::DESC]);
//        $storeLocator->setAddres($data['addres_store'][StoreLocatorInterface::ADDRES]);
//        $storeLocator->setLati($data['latitude'][StoreLocatorInterface::LATI]);
//        $storeLocator->setLongi($data['longitude'][StoreLocatorInterface::LONGI]);
//        $storeLocator->setWork($data['work_schedule'][StoreLocatorInterface::WORK]);
//        $redirectResult->setPath('*/*/new');
//        return $redirectResult;

//        var_dump($this->getRequest()->getParams());
//        die;
        if (isset($data['store_id'])) {
            $storeLocator->setId($data['store_id']);
        } else {
            $data['store_id'] = null;
        }
        $storeLocator->setId($data['store_id']);
        $storeLocator->setName($data['store_name']);
        $storeLocator->setDesc($data['description_store']);
        $storeLocator->setAddres($data['addres_store']);
        $storeLocator->setLati($data['latitude']);
        $storeLocator->setLongi($data['longitude']);
        $storeLocator->setWork($data['work_schedule']);
        $storeLocator= $this->setImage($data, $storeLocator);
        $storeLocator->setUrl($data['url_key']);
        $this->storeLocatorRepository->save($storeLocator);

        $redirectResult->setPath('*/*/index');
        return $redirectResult;
//        $storeLocator->setId($data->getParam('store_id'))
//            ->setDesc($data->getParam('description_store'))
//            ->setName($data->getParam('store_name'))
//            ->setAddres($data->getParam('addres_store'))
//            ->setWork($data->getParam('work_schedule'))
//            ->setLati($data->getParam('latitude'))
//            ->setLongi($data->getParam('longitude'));
//
//        $redirectResult->setPath('*/*/index');
//        return $redirectResult;
    }

    private function processRedirectAfterSuccessSave(Redirect $resultRedirect, string $id)
    {
        if ($this->getRequest()->getParam('back')) {
            $resultRedirect->setPath(
                '*/*/edit',
                [
                    StoreLocatorInterface::ID => $id,
                    '_current' => true,
                ]
            );
        } elseif ($this->getRequest()->getParam('redirect_to_new')) {
            $resultRedirect->setPath(
                '*/*/new',
                [
                    '_current' => true,
                ]
            );
        } else {
            $resultRedirect->setPath('*/*/');
        }
    }

    /**
     * @throws LocalizedException
     */
    public function setImage($data, StoreLocatorInterface $model): StoreLocatorInterface
    {
        if (isset($data['image'][0]['name'], $data['image'][0]['tmp_name'])) {
            $data['image'] = $data['image'][0]['name'];
            $this->imageUploader->moveFileFromTmp($data['image']);
        } elseif (isset($data['image'][0]['name']) && !isset($data['image'][0]['tmp_name'])) {
            $data['image'] = $data['image'][0]['name'];
        } else {
            $data['image'] = '';
        }
        $model->setImage($data['image']);
        return $model;
    }

}
