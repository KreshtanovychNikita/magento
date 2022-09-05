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

class NewAction extends Action
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
        /** @var Page $result */
        $result = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $result->setActiveMenu('Slark_StoreLocator::store_locator')
            ->addBreadcrumb(__('New Store'), __('Store Locator'));
        $result->getConfig()->getTitle()->prepend(__('New Store'));

        return $result;
    }
}

