<?php

namespace Mykyta\DataList\Controller\Adminhtml\DataList;

use Mykyta\DataList\Api\DataListRepositoryInterface;
use Mykyta\DataList\Model\DataListFactory;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Controller\ResultInterface;
use Mykyta\DataList\Api\Data\DataListInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\InventoryApi\Api\Data\SourceInterface;
use Mykyta\DataList\Model\DataListRepository;

class Save extends Action implements HttpPostActionInterface
{
    private DataListRepositoryInterface $dataListRepository;
    private DataListFactory $dataListFactory;

    public function __construct(
        Context $context,
        DataListRepository $dataListRepository,
        DataListFactory $dataListFactory
    ) {
        parent::__construct($context);
        $this->dataListRepository = $dataListRepository;
        $this->dataListFactory = $dataListFactory;
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
            $id = $requestData['general'][DataListInterface::ID];
            $dataList = $this->dataListRepository->get($id);
        } catch (\Exception $e) {
            $dataList = $this->dataListFactory->create();
        }

        $dataList->setType($requestData['general'][DataListInterface::TYPE]);
        try {
            $dataList = $this->dataListRepository->save($dataList);
            $this->processRedirectAfterSuccessSave($resultRedirect, $dataList->getId());
            $this->messageManager->addSuccessMessage(__('Product type was saved.'));

        } catch (\Exception $exception) {
            $this->messageManager->addErrorMessage(__('Error. Cannot save'));

            $resultRedirect->setPath('*/*/new');
        }

        return $resultRedirect;
    }

    private function processRedirectAfterSuccessSave(Redirect $resultRedirect, string $id)
    {
        if ($this->getRequest()->getParam('back')) {
            $resultRedirect->setPath(
                '*/*/edit',
                [
                    DataListInterface::ID => $id,
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

