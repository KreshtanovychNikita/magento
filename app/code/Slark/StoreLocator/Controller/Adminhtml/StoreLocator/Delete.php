<?php

namespace Slark\StoreLocator\Controller\Adminhtml\StoreLocator;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Slark\StoreLocator\Api\Data\StoreLocatorInterface;

class Delete extends Action implements HttpPostActionInterface
{
    private StoreLocatorInterface $storeLocatorRepository;

    public function __construct(
        Context $context,
        StoreLocatorInterface $storeLocatorRepository
    ) {
        parent::__construct($context);
        $this->storeLocatorRepository = $storeLocatorRepository;
    }

    public function execute(): ResultInterface
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $request = $this->getRequest();
        $dataListId = (int)$this->getRequest()->getParam('id');

        if (!$dataListId) {
            $this->messageManager->addErrorMessage(__('Error.'));
            return $resultRedirect->setPath('*/*/index');
        }

        try {
            $storeLocator = $this->storeLocatorRepository->get($storeLocatorId);
            $this->storeLocatorRepository->delete($storeLocator);
            $this->messageManager->addSuccessMessage(__('You deleted the product type.'));
        } catch (NoSuchEntityException $e) {
            $this->messageManager->addErrorMessage(__('Cannot delete product type'));
        }
        return $resultRedirect->setPath('*/*/index');
    }
}
