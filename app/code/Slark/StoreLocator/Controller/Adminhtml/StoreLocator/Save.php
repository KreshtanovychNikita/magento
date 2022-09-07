<?php

namespace Slark\StoreLocator\Controller\Adminhtml\StoreLocator;

use Slark\StoreLocator\Api\StoreLocatorRepositoryInterface;
use Slark\StoreLocator\Model\StoreLocatorFactory;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Controller\ResultInterface;
use Slark\StoreLocator\Api\Data\StoreLocatorInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\InventoryApi\Api\Data\SourceInterface;
use Slark\StoreLocator\Model\StoreLocatorRepository;

class Save extends Action implements HttpPostActionInterface
{
    private StoreLocatorRepositoryInterface $storeLocatorRepository;
    private StoreLocatorFactory $storeLocatorFactory;

    public function __construct(
        Context $context,
        StoreLocatorRepository $storeLocatorRepository,
        StoreLocatorFactory $storeLocatorFactory
    ) {
        parent::__construct($context);
        $this->storeLocatorRepository = $storeLocatorRepository;
        $this->storeLocatorFactory = $storeLocatorFactory;
    }

    public function execute(): ResultInterface
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $request = $this->getRequest();
        $requestData = $request->getPost()->toArray();

//        if (!$request->isPost() || empty($requestData['general'])) {
//            $this->messageManager->addErrorMessage(__('Wrong request.'));
//            $resultRedirect->setPath('*/*/new');
//            return $resultRedirect;
//        }

        try {
            $id = $requestData['general'][StoreLocatorInterface::ID];
            $storeLocator = $this->storeLocatorRepository->get($id);
        } catch (\Exception $e) {
            $storeLocator = $this->storeLocatorFactory->create();
        }

        $storeLocator->setName($request->getParam('store_name'))
            ->setEmail($request->getParam('email'))
            ->setMessage($request->getParam('message'))
            ->setStatus((int) $request->getParam('status'))
            ->setStoreId((int) $request->getParam('store_id'));


    }

    public function setImage($data, $store): StoreLocatorInterface
    {
        if (isset($data['image'][0]['name']) && isset($data['image'][0]['tmp_name'])) {
            $data['image'] = $data['image'][0]['name'];
            $this->imageUploader->moveFileFromTmp($data['image']);
        } elseif (isset($data['image'][0]['name']) && !isset($data['image'][0]['tmp_name'])) {
            $data['image'] = $data['image'][0]['name'];
        } else {
            $data['image'] = '';
        }
        $store->setImage($data['image']);
        return $store;
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
}

