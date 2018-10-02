<?php

namespace Neklo\News\Controller\Adminhtml\Category;

class Validate extends \Magento\Backend\App\Action
{
    /**
     * @var \Magento\Framework\Controller\Result\JsonFactory
     */
    private $resultJsonFactory;
    /**
     * @var \Magento\Framework\DataObject
     */
    private $dataObject;
    /**
     * @var \Neklo\News\Model\CategoryFactory
     */
    private $modelFactory;

    /**
     * Validate constructor.
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory
     * @param \Magento\Framework\View\LayoutFactory $layoutFactory
     * @param \Magento\Framework\DataObject $dataObject
     * @param \Neklo\News\Model\CategoryFactory $modelFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory,
        \Magento\Framework\View\LayoutFactory $layoutFactory,
        \Magento\Framework\DataObject $dataObject,
        \Neklo\News\Model\CategoryFactory $modelFactory
    ) {
        parent::__construct($context);
        $this->resultJsonFactory = $resultJsonFactory;
        $this->layoutFactory = $layoutFactory;
        $this->dataObject = $dataObject;
        $this->modelFactory = $modelFactory;
    }

    /**
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $errorMs = $this->cheakPostValues($this->_request->getParams());
        if ($errorMs) {
            $this->dataObject->setError(true);
            $this->dataObject->setMessages($errorMs);
        }
        return $this->resultJsonFactory->create()->setData($this->dataObject);
    }

    /*
     * @return array
     */
    public function cheakPostValues($data)
    {
        $errorMs = [];
        if ($data) {
            if (!isset($data['category']) || !$data['category']) {
                $errorMs[] = 'length field for category must to be 3 to 15 symbols';
            } elseif (!isset($data['id']) || !is_numeric($data['id'])) {
                $errorMs[] = 'something went wrong';
            }
        } else {
            $errorMs[] = 'something went wrong';
        }
        return $errorMs;
    }
}
