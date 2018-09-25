<?php


namespace Neklo\News\Controller\Adminhtml\Article;

class Validate extends \Magento\Backend\App\Action
{
    private $resultJsonFactory;
    private $response;
    private $registry;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory,
        \Magento\Framework\View\LayoutFactory $layoutFactory,
        \Magento\Framework\DataObject $response,
        \Magento\Framework\Registry $registry,
        array $multipleAttributeList = []
    ) {
        parent::__construct($context);
        $this->resultJsonFactory = $resultJsonFactory;
        $this->layoutFactory = $layoutFactory;
        $this->multipleAttributeList = $multipleAttributeList;
        $this->return = $multipleAttributeList;
        $this->response = $response;
        $this->registry = $registry;
    }

    /**
     * @return \Magento\Framework\Controller\ResultInterface
     */

    public function cheakError($data)
    {
        $error = [];
        $myError = [
            'url_key' => 'length field for name link title must to be 3 to 15 symbols',
            'title' => 'length field for title must to be 3 to 15 symbols',
            'content' => 'length field for content must to be 3 to 15 symbols',
            'categories_id' => 'something went wrong',
            'id' => 'something went wrong',
        ];
        if ($data) {
            foreach ($myError as $nameRul => $value) {
                if (!isset($data[$nameRul]) || !$data[$nameRul]) {
                    $error[] = $value;
                }
            }
        } else {
            $error[] = 'something went wrong';
        }
        return $error;
    }

    public function execute()
    {
        $data = $this->_request->getParams();
        $error = $this->cheakError($data);
        if ($error) {
            $this->response->setError(true);

            $this->response->setMessages(
                $error
            );
        }
        return $this->resultJsonFactory->create()->setData($this->response);
    }
}
