<?php

namespace Slark\StoreLocator\Controller\Adminhtml\StoreLocator;

use Slark\StoreLocator\Model\StoreLocatorRepository;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Page;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\InventoryApi\Api\Data\SourceInterface;
use Slark\StoreLocator\Api\Data\StoreLocatorInterface;

class Edit extends Action
{
    /**
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Slark_StoreLocator::store_locator';
    private StoreLocatorRepository $storeLocatorRepository;

    public function __construct(
        Context $context,
        StoreLocatorRepository $storeLocatorRepository
    ) {
        parent::__construct($context);
        $this->storeLocatorRepository = $storeLocatorRepository;
    }


    public function execute(): ResultInterface
    {
        $id = $this->getRequest()->getParam('id');
        try {
            $type = $this->storeLocatorRepository->get($id);

            /** @var Page $result */
            $result = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
            $result->setActiveMenu('Slark_StoreLocator::store_locator')
                ->addBreadcrumb(__('Edit Store Locator'), __('Store Locator'));
            $result->getConfig()
                ->getTitle()
                ->prepend(__('Edit Store Locator: %type', ['type' => $type->getType()]));
        } catch (NoSuchEntityException $e) {
            /** @var Redirect $result */
            $result = $this->resultRedirectFactory->create();
            $this->messageManager->addErrorMessage(
                __('Store with id "%value" does not exist.', ['value' => $id])
            );
            $result->setPath('*/*');
        }

        return $result;
    }
}
