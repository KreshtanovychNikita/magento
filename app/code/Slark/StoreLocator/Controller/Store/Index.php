<?php

namespace Slark\StoreLocator\Controller\Store;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\App\RequestInterface as Request;
use Magento\Framework\Controller\Result\ForwardFactory;
use Magento\Framework\View\Result\PageFactory;

class Index implements HttpGetActionInterface
{
    protected PageFactory $pageFactory;
    protected Request $request;
    protected ForwardFactory $forward;

    /**
     * @param PageFactory $pageFactory
     * @param ForwardFactory $forward
     * @param Request $request
     */
    public function __construct(
        PageFactory $pageFactory,
        ForwardFactory $forward,
        Request $request
    ) {
        $this->pageFactory = $pageFactory;
        $this->request = $request;
        $this->forward = $forward;
    }

    /**
     * @inheritDoc
     */
    public function execute()
    {
        $page = $this->pageFactory->create();
        $store = $this->request->getParam('store');
        //$data = $store->getData();
        if (!$store) {
            return $this->forward->create()->setController('index')->forward('index');
        }

//        if (empty($data)) {
//            return null;
//        }

        $name = $store->getStoreName();
        $page->setHeader('name', $name);
        $page->getConfig()->getTitle()->prepend($name);
        return $page;
    }
}
