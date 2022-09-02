<?php

namespace Mykyta\DataList\Controller\Adminhtml\DataList;

use Mykyta\DataList\Model\DataListRepository;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\View\Result\Page;
use Magento\Framework\Controller\Result\Redirect;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\InventoryApi\Api\Data\SourceInterface;
use Mykyta\DataList\Api\Data\DataListInterface;

class NewAction extends Action
{
    /**
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Mykyta_DataList::data_list';
    private DataListRepository $dataListRepository;

    public function __construct(
        Context $context,
        DataListRepository $dataListRepository
    ) {
        parent::__construct($context);
        $this->dataListRepository = $dataListRepository;
    }


    public function execute(): ResultInterface
    {
        /** @var Page $result */
        $result = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $result->setActiveMenu('Mykyta_DataList::data_list')
            ->addBreadcrumb(__('New Data'), __('Data List'));
        $result->getConfig()->getTitle()->prepend(__('New Data List'));

        return $result;
    }
}

