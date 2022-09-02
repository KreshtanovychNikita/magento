<?php

namespace Mykyta\DataList\UI\Component\Control\DataList;

use Mykyta\DataList\Model\DataListRepository;
use Magento\Framework\App\RequestInterface;
use Magento\Framework\UrlInterface;
use phpDocumentor\Reflection\Utils;

class GenericButton
{
    private UrlInterface $urlBuilder;
    private RequestInterface $request;
    private DataListRepository $dataListRepository;

    public function __construct(
        UrlInterface $urlBuilder,
        RequestInterface $request,
        DataListRepository $dataListRepository
    ) {
        $this->urlBuilder = $urlBuilder;
        $this->request = $request;
        $this->dataListRepository = $dataListRepository;
    }

    public function getUrl($route = '', $params = [])
    {
        return $this->urlBuilder->getUrl($route, $params);
    }

    public function getProductType()
    {
        $dataListId = $this->request->getParam('id');
        if ($dataListId === null) {
            return 0;
        }
        $dataList = $this->dataListRepository->get($dataListId);

        return $dataList->getId() ?: null;
    }
}
