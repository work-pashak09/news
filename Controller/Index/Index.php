<?php

namespace Neklo\News\Controller\Index;

use Magento\Framework\App\Action\Context;

class Index extends \Magento\Framework\App\Action\Action
{
    private $resultPageFactory;
    private $helper;

    public function __construct(
        Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Neklo\News\Helper\Config $helper
    ) {
        $this->helper = $helper;
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

    public function execute()
    {
        if ($this->helper->getIsEnabled()) {
            $resultPage = $this->resultPageFactory->create();
            return $resultPage;
        } else {
            return $this->_redirect('/*/*/');
        }
    }
}
