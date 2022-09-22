<?php
//
//namespace Slark\StoreLocator\Controller\Adminhtml\StoreLocator\Image;
//
//use Magento\Backend\App\Action;
//use Magento\Backend\App\Action\Context;
//use Magento\Catalog\Model\ImageUploader;
//use Magento\Framework\App\Action\HttpPostActionInterface;
//use Magento\Framework\Controller\ResultFactory;
//use Magento\Framework\Controller\ResultInterface;
//use Magento\Framework\File\UploaderFactory;
//use Magento\Framework\View\FileSystem;
//use Magento\Store\Model\StoreManagerInterface;
//
//class Upload extends Action implements HttpPostActionInterface
//{
//    /**
//     * Image uploader
//     *
//     * @var ImageUploader
//     */
//    protected ImageUploader $imageUploader;
//
//    /**
//     * Upload constructor.
//     *
//     * @param Context $context
//     * @param ImageUploader $imageUploader
//     */
//    /**
//     * Upload file controller action
//     *
//     * @return ResultInterface
//     */
//
//    /**
//     * @param Context $context
//     * @param UploaderFactory $uploaderFactory
//     * @param StoreManagerInterface $storeManager
//     * @param FileSystem $fileSystem
//     * @param ImageUploader $imageUploader
//     */
//    public function __construct(
//        Context               $context,
//        UploaderFactory       $uploaderFactory,
//        StoreManagerInterface $storeManager,
//        FileSystem            $fileSystem,
//        ImageUploader         $imageUploader
//    ) {
//        $this->imageUploader = $imageUploader;
//        $this->storeManager = $storeManager;
//        $this->fileSystem = $fileSystem;
//        parent::__construct($context);
//    }
//
//    public function execute()
//    {
////        var_dump();
////        die;
//        $imageId = $this->_request->getParam('param_name');
//        try {
////            var_dump();
////            die;
//            $result = $this->imageUploader->saveFileToTmpDir($imageId);
//        } catch (\Exception $e) {
//            $result = ['error' => $e->getMessage(), 'errorcode' => $e->getCode()];
//        }
//        return $this->resultFactory->create(ResultFactory::TYPE_JSON)->setData($result);
//    }
//}
