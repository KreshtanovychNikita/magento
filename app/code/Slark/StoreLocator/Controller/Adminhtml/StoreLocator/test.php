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

        if (!$request->isPost() || empty($requestData['general'])) {
            $this->messageManager->addErrorMessage(__('Wrong request.'));
            $resultRedirect->setPath('*/*/new');
            return $resultRedirect;
        }

        try {
            $id = $requestData['general'][StoreLocatorInterface::ID];
            $storeLocator = $this->storeLocatorRepository->get($id);
        } catch (\Exception $e) {
            $storeLocator = $this->storeLocatorFactory->create();
        }

        $storeLocator->setName($requestData['general'][StoreLocatorInterface::NAME]);
        try {
            $storeLocator = $this->storeLocatorRepository->save($storeLocator);
            $this->processRedirectAfterSuccessSave($resultRedirect, $storeLocator->getName());
            $this->messageManager->addSuccessMessage(__('Product type was saved.'));

        } catch (\Exception $exception) {
            $this->messageManager->addErrorMessage(__('Error. Cannot save'));

            $resultRedirect->setPath('*/*/new');
        }

        $storeLocator->setAddres($requestData['general'][StoreLocatorInterface::ADDRES]);
        try {
            $storeLocator = $this->storeLocatorRepository->save($storeLocator);
            $this->processRedirectAfterSuccessSave($resultRedirect, $storeLocator->getAddres());
            $this->messageManager->addSuccessMessage(__('Product type was saved.'));

        } catch (\Exception $exception) {
            $this->messageManager->addErrorMessage(__('Error. Cannot save'));

            $resultRedirect->setPath('*/*/new');
        }

        $storeLocator->setWork($requestData['general'][StoreLocatorInterface::WORK]);
        try {
            $storeLocator = $this->storeLocatorRepository->save($storeLocator);
            $this->processRedirectAfterSuccessSave($resultRedirect, $storeLocator->getWork());
            $this->messageManager->addSuccessMessage(__('Product type was saved.'));

        } catch (\Exception $exception) {
            $this->messageManager->addErrorMessage(__('Error. Cannot save'));

            $resultRedirect->setPath('*/*/new');
        }

        $storeLocator->setLati($requestData['general'][StoreLocatorInterface::LATI]);
        try {
            $storeLocator = $this->storeLocatorRepository->save($storeLocator);
            $this->processRedirectAfterSuccessSave($resultRedirect, $storeLocator->getLati());
            $this->messageManager->addSuccessMessage(__('Product type was saved.'));

        } catch (\Exception $exception) {
            $this->messageManager->addErrorMessage(__('Error. Cannot save'));

            $resultRedirect->setPath('*/*/new');
        }

        $storeLocator->setLongi($requestData['general'][StoreLocatorInterface::LONGI]);
        try {
            $storeLocator = $this->storeLocatorRepository->save($storeLocator);
            $this->processRedirectAfterSuccessSave($resultRedirect, $storeLocator->getLongi());
            $this->messageManager->addSuccessMessage(__('Product type was saved.'));

        } catch (\Exception $exception) {
            $this->messageManager->addErrorMessage(__('Error. Cannot save'));

            $resultRedirect->setPath('*/*/new');
        }


        return $resultRedirect;
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

