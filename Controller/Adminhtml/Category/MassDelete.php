<?php

namespace Neklo\News\Controller\Adminhtml\Category;

use Magento\Backend\App\Action;

class MassDelete extends \Neklo\News\Controller\Adminhtml\MassAction\Delete
{
    /** @var \Neklo\News\Model\ResourceModel\Category\CollectionFactory  */
    private $collectionFactory;

    public function __construct(
        Action\Context $context,
        \Neklo\News\Model\ResourceModel\Category\CollectionFactory $collectionFactory
    ) {
        parent::__construct($context);
        $this->collectionFactory = $collectionFactory;
    }

    public function getCollectionFactory()
    {
        return $this->collectionFactory;
    }
}
