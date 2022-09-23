<?php
//
//
//namespace Slark\StoreLocator\Controller\Adminhtml\Stores;
//
//use Magento\Framework\Controller\ResultFactory;
//use Magento\Framework\Controller\ResultInterface;
//
//class Index extends \Magento\Backend\App\Action implements \Magento\Framework\App\Action\HttpGetActionInterface
//{
//    public const ADMIN_RESOURCE = 'Slark_StoreLocator::store_locator';
//
//    /**
//     * @inheritDoc
//     * @throws \JsonException
//     */
//    public function execute():ResultInterface
//    {
//        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
//        $resultPage->setActiveMenu('Slark_StoreLocator::store_locator')->
//        getConfig()->getTitle()->prepend(__('Store Locator'));
//
//        return $resultPage;
//    }
//}
