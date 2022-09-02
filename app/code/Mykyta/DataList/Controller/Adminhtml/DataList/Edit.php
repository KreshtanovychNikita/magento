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

class Edit extends Action
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
        $id = $this->getRequest()->getParam('id');
        try {
            $type = $this->dataListRepository->get($id);

            /** @var Page $result */
            $result = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
            $result->setActiveMenu('Mykyta_DataList::data_list')
                ->addBreadcrumb(__('Edit Data List'), __('Data List'));
            $result->getConfig()
                ->getTitle()
                ->prepend(__('Edit Data List: %type', ['type' => $type->getType()]));
        } catch (NoSuchEntityException $e) {
            /** @var Redirect $result */
            $result = $this->resultRedirectFactory->create();
            $this->messageManager->addErrorMessage(
                __('Product type with id "%value" does not exist.', ['value' => $id])
            );
            $result->setPath('*/*');
        }

        return $result;
    }
}
