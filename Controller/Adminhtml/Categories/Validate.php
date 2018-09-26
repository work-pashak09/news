<?php
/**
 * Created by PhpStorm.
 * User: php
 * Date: 21.09.18
 * Time: 12:13
 */

namespace Neklo\News\Controller\Adminhtml\Categories;

class Validate extends \Magento\Backend\App\Action
{
    private $resultJsonFactory;
    private $response;
    private $modelFactory;


    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory,
        \Magento\Framework\View\LayoutFactory $layoutFactory,
        \Magento\Framework\DataObject $response,
        \Neklo\News\Model\CategoriesFactory $modelFactory,
        array $multipleAttributeList = []
    ) {
        parent::__construct($context);
        $this->resultJsonFactory = $resultJsonFactory;
        $this->layoutFactory = $layoutFactory;
        $this->multipleAttributeList = $multipleAttributeList;
        $this->return = $multipleAttributeList;
        $this->response = $response;

        $this->modelFactory = $modelFactory;
    }

    /**
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $data = $this->_request->getParams();
        $error = [];
        $myError = [
            'category' => 'length field for category must to be 3 to 15 symbols',
            'id' => 'something went wrong',
        ];
        if ($data) {
            if (!isset($data['category']) || !$data['category']) {
                $error[] = $myError['category'];
            }
            if (!isset($data['id']) || !is_numeric($data['id'])) {
                $error[] = 'something went wrong';
            }
            /** @var \Neklo\News\Model\Categories $model */
            $model = $this->modelFactory->create();
            $iscloset = $model->load($data['category'], 'category');
            if ($iscloset) {
                $error[] = "it's name category is busy";
            }
        } else {
            $error[] = 'something went wrong';
        }
        if ($error) {
            $this->response->setError(true);
            $this->response->setMessages($error);
        }
        return $this->resultJsonFactory->create()->setData($this->response);
    }
}
