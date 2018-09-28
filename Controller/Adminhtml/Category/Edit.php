<?php

namespace Neklo\News\Controller\Adminhtml\Category;

use Magento\Framework\Registry;

class Edit extends \Magento\Backend\App\Action
{
    const ADMIN_RESOURCE = 'Neklo_News::article';
    /** @var bool|\Magento\Framework\View\Result\PageFactory */
    private $resultPageFactory = false;
    /** @var Registry */
    private $registry;
    /** @var \Neklo\News\Model\Category */
    private $model;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Neklo\News\Model\Category $model,
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
        if ($param && is_numeric($param) && $this->model->getOne($param)) {
            $resultPage = $this->resultPageFactory->create();
            $resultPage->getConfig()->getTitle()->prepend((__('Edit Category')));
            $this->registry->register(
                'id',
                $param
            );
        } else {
            $resultPage = $this->resultPageFactory->create();
        }
        return $resultPage;
    }
}