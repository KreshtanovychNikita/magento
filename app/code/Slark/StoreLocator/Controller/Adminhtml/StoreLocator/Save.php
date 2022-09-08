<?php

namespace Slark\StoreLocator\Controller\Adminhtml\StoreLocator;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Controller\Result\RedirectFactory;
use Magento\Framework\Controller\ResultInterface;
use Slark\StoreLocator\Api\Data\StoreLocatorInterface;
use Slark\StoreLocator\Api\StoreLocatorRepositoryInterface;
use Slark\StoreLocator\Model\StoreLocatorFactory;
use Slark\StoreLocator\Model\StoreLocatorRepository;

class Save extends Action implements HttpPostActionInterface
{
    private StoreLocatorRepositoryInterface $storeLocatorRepository;
    private StoreLocatorFactory $storeLocatorFactory;
    private RedirectFactory $redirectFactory;

    public function __construct(
        Context $context,
        StoreLocatorRepository $storeLocatorRepository,
        StoreLocatorFactory $storeLocatorFactory,
        RedirectFactory     $redirectFactory
    ) {
        parent::__construct($context);
        $this->storeLocatorRepository = $storeLocatorRepository;
        $this->storeLocatorFactory = $storeLocatorFactory;
        $this->redirectFactory = $redirectFactory;
    }

    public function execute()
    {
        $redirectResult = $this->redirectFactory->create();
        $storeLocator= $this->storeLocatorFactory->create();
        $data = $this->getRequest()->getPostValue();

//        var_dump($this->getRequest()->getParams());
//        die;
        if (isset($data['store_id'])) {
            $storeLocator->setId($data['store_id']);
        } else {
            $data['store_id'] = null;
        }
        $storeLocator->setName($data['name']);
        $storeLocator->setDesc($data['description_store']);
        $storeLocator->setAddres($data['address_store']);
        $storeLocator->setLati($data['latitude']);
        $storeLocator->setLongi($data['longitude']);
        $storeLocator->setWork($data['work_schedule']);
//        $storeLocator= $this->setImage($data, $store);
//        $storeLocator->setUrl($data['store_url_key']);
        $this->storeRepository->save($storeLocator);

        $redirectResult->setPath('*/*/index');
        return $redirectResult;
    }


//    public function setImage($data, $store): StoreLocatorInterface
//    {
//        if (isset($data['image'][0]['name']) && isset($data['image'][0]['tmp_name'])) {
//            $data['image'] = $data['image'][0]['name'];
//            $this->imageUploader->moveFileFromTmp($data['image']);
//        } elseif (isset($data['image'][0]['name']) && !isset($data['image'][0]['tmp_name'])) {
//            $data['image'] = $data['image'][0]['name'];
//        } else {
//            $data['image'] = '';
//        }
//        $storeLocator->setImage($data['image']);
//        return $store;
//    }

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
}
