<?php

namespace Neklo\News\Controller\Adminhtml\Article;

class Validate extends \Magento\Backend\App\Action
{
    /**
     * @var \Magento\Framework\DataObject
     */
    private $dataObject;
    /**
     * @var \Magento\Framework\Registry
     */
    private $registry;
    /**
     * @var \Magento\Framework\Controller\Result\JsonFactory
     */
    private $resultJsonFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\DataObject $dataObject
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\DataObject $dataObject,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory
    ) {
        parent::__construct($context);
        $this->dataObject = $dataObject;
        $this->registry = $registry;
        $this->resultJsonFactory = $resultJsonFactory;
    }
    /**
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function cheakPostData($data)
    {
        $errorMessage = [];
        $errorList = [
            'url_key' => 'length field for name link title must to be 3 to 15 symbols',
            'title' => 'length field for title must to be 3 to 15 symbols',
            'content' => 'length field for content must to be 3 to 15 symbols',
            'category_id' => 'something went wrong',
            'id' => 'something went wrong',
        ];
        if ($data) {
            foreach ($errorList as $nameRul => $value) {
                if (!isset($data[$nameRul]) || !$data[$nameRul]) {
                    $errorMessage[] = $value;
                }
            }
        } else {
            $errorMessage[] = 'something went wrong';
        }
        return $errorMessage;
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\Result\Json|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $data = $this->_request->getParams();
        $errorMessage = $this->cheakPostData($data);
        if ($errorMessage) {
            $this->dataObject->setError(true);
            $this->dataObject->setMessages($errorMessage);
        }
        return $this->resultJsonFactory->create()->setData($this->dataObject);
    }
}
