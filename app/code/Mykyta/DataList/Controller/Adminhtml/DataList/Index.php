<?php

namespace Mykyta\DataList\Controller\Adminhtml\DataList;

use Magento\Backend\App\Action;
use Magento\Backend\Model\View\Result\Page;
use Magento\Framework\Controller\ResultFactory;
use Magento\Framework\Controller\ResultInterface;

class Index extends Action
{
    /**
     * @see _isAllowed()
     */
    const ADMIN_RESOURCE = 'Mykyta_DataList::data_list';

    public function execute(): ResultInterface
    {
        /** @var Page $resultPage */
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $resultPage->setActiveMenu('Mykyta_DataList::mykyta')
            ->addBreadcrumb(__('Data List'), __('List'));
        $resultPage->getConfig()->getTitle()->prepend(__('Data List'));

        return $resultPage;
    }
}
