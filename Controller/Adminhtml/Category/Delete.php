<?php

namespace Neklo\News\Controller\Adminhtml\Category;

use Magento\Backend\App\Action;
use Neklo\News\Model\Category as ModelData;

class Delete extends \Magento\Backend\App\Action
{
    const ADMIN_RESOURCE = 'Neklo_News::category_delete';
    /** @var ModelData  */
    private $newsModel;
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        ModelData $newsModel
    ) {
        $this->newsModel = $newsModel;
        parent::__construct($context);
    }

    public function execute()
    {
        try {
            $post = $this->getRequest()->getParam('id');
            $model = $this->newsModel->load($post);
            $model->delete();
            $this->messageManager->addSuccess(__('Delete sucses'));
            $this->_redirect('news/categories/index');
        } catch (\Exception $e) {
            $this->messageManager->addError('Something went wrong');
            $this->_redirect('news/categories/index');
        }
    }
}
