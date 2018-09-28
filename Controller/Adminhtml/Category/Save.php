<?php

namespace Neklo\News\Controller\Adminhtml\Category;

class Save extends \Magento\Backend\App\Action
{
    const ADMIN_RESOURCE = 'Neklo_News::save';
    /** @var \Neklo\News\Model\CategoryFactory */
    private $categoryFactory;
    /** @var Validate */
    private $validate;

    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Neklo\News\Model\CategoryFactory $categoryFactory,
        \Neklo\News\Controller\Adminhtml\Category\Validate $validate
    ) {
        $this->categoryFactory = $categoryFactory;
        $this->validate = $validate;
        parent::__construct($context);
    }

    public function execute()
    {
        try {
            $post = $this->getRequest()->getPost();
            $errorMs = $this->validate->cheakPostValues($post);
            if ($errorMs) {
                $this->messageManager->addErrorMessage($errorMs[0]);
                return $this->_redirect('news/category/index');
            }
            $category = $this->categoryFactory->create()->load($post['category'], 'category');
            if ($category->getId() !== $post['id']) {
                $this->messageManager->addErrorMessage("it's name category is busy");
                return $this->_redirect('news/category/index');
            }
            $category->addData($post)->save();
            $this->messageManager->addSuccess(__('Your values has beeen submitted successfully.'));
            $this->_redirect('news/category/index');
        } catch (\Exception $e) {
            $this->messageManager->addError('Something went wrong');
            $this->_redirect('news/category/index');
        }
    }
}
