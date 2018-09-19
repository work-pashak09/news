<?php
/**
 * Created by PhpStorm.
 * User: php
 * Date: 06.09.18
 * Time: 13:41
 */

namespace Neklo\News\Controller\Adminhtml\Article;

class Index extends \Magento\Backend\App\Action
{
    const ADMIN_RESOURCE = 'Neklo_News::article';
    private $resultPageFactory = false;

    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend((__('Posts')));
        return $resultPage;
    }

}