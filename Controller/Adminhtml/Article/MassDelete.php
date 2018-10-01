<?php

namespace Neklo\News\Controller\Adminhtml\Article;

use Magento\Backend\App\Action;

class MassDelete extends \Neklo\News\Controller\Adminhtml\MassAction\Delete
{
    /** @var \Neklo\News\Model\ResourceModel\Article\CollectionFactory  */
    private $collectionFactory;

    /**
     * @param Action\Context $context
     * @param \Neklo\News\Model\ResourceModel\Article\CollectionFactory $collectionFactory
     */
    public function __construct(
        Action\Context $context,
        \Neklo\News\Model\ResourceModel\Article\CollectionFactory $collectionFactory
    ) {
        parent::__construct($context);
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * @return \Neklo\News\Model\ResourceModel\Article\CollectionFactory
     */
    public function getCollectionFactory()
    {
        return $this->collectionFactory;
    }
}
