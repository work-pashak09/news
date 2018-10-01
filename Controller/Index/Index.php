<?php

namespace Neklo\News\Controller\Index;

use Magento\Framework\App\Action\Context;

class Index extends \Magento\Framework\App\Action\Action
{
    /** @var \Magento\Framework\View\Result\PageFactory  */
    private $resultPageFactory;
    /** @var \Neklo\News\Helper\Config  */
    private $helper;

    public function __construct(
        Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory,
        \Neklo\News\Helper\Config $config
    ) {
        $this->helper = $config;
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|\Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        if ($this->helper->isEnabledLinkOnNews()) {
            $resultPage = $this->resultPageFactory->create();
            return $resultPage;
        } else {
            return $this->_redirect('/*/*/');
        }
    }
}
