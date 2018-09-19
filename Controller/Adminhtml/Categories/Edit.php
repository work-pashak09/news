<?php


namespace Neklo\News\Controller\Adminhtml\Categories;

use Magento\Framework\Registry;

class Edit extends  \Magento\Backend\App\Action
{
    const ADMIN_RESOURCE = 'Neklo_News::article';
    protected $resultPageFactory = false;

    private $registry;
    private $model;


    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Neklo\News\Model\Categories $model,
        Registry $registry
    ) {
        parent::__construct($context);
        $this->registry = $registry;
        $this->resultPageFactory = $resultPageFactory;
        $this->model = $model;
    }

    public function execute()
    {

        $param = $this->getRequest()->getParam('id');


        if($param && is_numeric($param) && $this->model->getOne($param)) {
            $resultPage = $this->resultPageFactory->create();
            $resultPage->getConfig()->getTitle()->prepend((__('Edit Categories')));
        }
        else {
            $resultPage = $this->resultPageFactory->create();
        }
        return $resultPage;
    }
}