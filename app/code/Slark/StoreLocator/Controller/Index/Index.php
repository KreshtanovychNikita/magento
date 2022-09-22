<?php

namespace Slark\StoreLocator\Controller\Index;

use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\App\RequestInterface as Request;

class Index implements \Magento\Framework\App\Action\HttpGetActionInterface
{
    /**
     * @param PageFactory $pageFactory
     * @param Request $request
     */
    public function __construct(
        PageFactory $pageFactory,
        Request $request
    ) {
        $this->pageFactory = $pageFactory;
        $this->request = $request;
    }

    public function execute()
    {
        return $this->pageFactory->create();
    }
}
