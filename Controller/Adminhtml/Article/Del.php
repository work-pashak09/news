<?php

namespace Neklo\News\Controller\Adminhtml\Article;

use Magento\Backend\App\Action;
use Neklo\News\Model\News as ModelData;

class Del extends \Magento\Backend\App\Action
{

    const ADMIN_RESOURCE = 'Neklo_News::delete';

    private $newsModel;

    /**
     * @param Action\Context $context
     */

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        ModelData $newsModel
    ) {
        $this->newsModel = $newsModel;
        parent::__construct($context);
    }

    public function execute()
    {
        $post = $this->getRequest()->getParam('id');
        $model = $this->newsModel->load($post);
        $model->delete();
        $this->messageManager->addSuccess(__('Delete sucses'));
        $this->_redirect('article/index');
    }

}