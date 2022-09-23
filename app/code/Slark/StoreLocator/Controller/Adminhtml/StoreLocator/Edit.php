<?php

namespace Slark\StoreLocator\Controller\Adminhtml\StoreLocator;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Controller\ResultFactory;
use Slark\StoreLocator\Api\Data\StoreLocatorInterfaceFactory;
use Slark\StoreLocator\Api\Data\StoreLocatorInterfaceFactory as StoreLocatorFactory;
use Slark\StoreLocator\Model\ResourceModel\StoreLocator as StoreLocatorResource;
use Slark\StoreLocator\Model\StoreLocatorRepository;

class Edit extends Action
{
    //public const ADMIN_RESOURCE = Authorization::ACTION_STORE_LOCATOR_EDIT;
    /**
     * @see _isAllowed()
     * @param StoreLocatorFactory $storeLocatorFactory
     * @param StoreLocatorResource $storeLocatorResource
     * @param Context $context

     */
    const ADMIN_RESOURCE = 'Slark_StoreLocator::store_locator';
    private StoreLocatorRepository $storeLocatorRepository;
//    private StoreLocatorInterfaceFactory $storeLocatorFactory;
//    protected StoreLocatorResource $storeLocatorResource;

    public function __construct(
        Context $context,
        StoreLocatorRepository $storeLocatorRepository,
        StoreLocatorInterfaceFactory $storeLocatorFactory,
        StoreLocatorResource        $storeLocatorResource

    ) {
        parent::__construct($context);
        $this->storeLocatorRepository = $storeLocatorRepository;
        $this->storeLocatorFactory = $storeLocatorFactory;
        $this->storeLocatorResource =$storeLocatorResource;
    }

    public function execute() : \Magento\Framework\Controller\ResultInterface
    {
        $storeLocator = $this->storeLocatorFactory->create();

        if ($entityId = (int) $this->getRequest()->getParam('store_id')) {
            $this->storeLocatorResource->load($storeLocator, $entityId);

            if (!$storeLocator->getId()) {
                $this->messageManager->addErrorMessage(__('This store no exists'));

                /** @var Redirect $resultRedirect */
                $resultRedirect = $this->resultRedirectFactory->create();

                return $resultRedirect->setPath('*/*/');
            }
        }

        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultPage->getConfig()->getTitle()->prepend(
            $storeLocator->getId() ? __('Edit Store') : __('New Store')
        );

        return $resultPage;
    }
}
