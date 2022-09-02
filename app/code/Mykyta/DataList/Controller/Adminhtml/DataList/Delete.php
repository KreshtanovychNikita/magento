<?php

namespace Mykyta\DataList\Controller\Adminhtml\DataList;

use Mykyta\DataList\Api\Data\DataListInterface;
use Mykyta\DataList\Api\DataListRepositoryInterface;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\NoSuchEntityException;

class Delete extends Action implements HttpPostActionInterface
{

    private DataListRepositoryInterface $dataListRepository;

    public function __construct(
        Context $context,
        DataListRepositoryInterface $dataListRepository
    ) {
        parent::__construct($context);
        $this->dataListRepository = $dataListRepository;
    }

    public function execute(): ResultInterface
    {
        $resultRedirect = $this->resultRedirectFactory->create();
        $request = $this->getRequest();
        $dataListId = (int)$this->getRequest()->getParam('id');

        if(!$dataListId) {
            $this->messageManager->addErrorMessage(__('Error.'));
            return $resultRedirect->setPath('*/*/index');

        }

        try {
            $dataList = $this->dataListRepository->get($dataListId);
            $this->dataListRepository->delete($dataList);
            $this->messageManager->addSuccessMessage(__('You deleted the product type.'));

        } catch (NoSuchEntityException $e) {
            $this->messageManager->addErrorMessage(__('Cannot delete product type'));

        }
        return $resultRedirect->setPath('*/*/index');
    }
}

