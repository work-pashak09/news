<?php

namespace Neklo\News\Controller\Adminhtml\Category;

use Magento\Backend\App\Action;

class MassDelete extends \Neklo\News\Controller\Adminhtml\MassAction\Delete
{
    const ADMIN_RESOURCE = 'Neklo_News::category_delete';
    /**
     * @var \Neklo\News\Model\ResourceModel\Category\CollectionFactory
     */
    private $collectionFactory;

    /**
     * MassDelete constructor.
     * @param Action\Context $context
     * @param \Neklo\News\Model\ResourceModel\Category\CollectionFactory $collectionFactory
     */
    public function __construct(
        Action\Context $context,
        \Neklo\News\Model\ResourceModel\Category\CollectionFactory $collectionFactory
    ) {
        parent::__construct($context);
        $this->collectionFactory = $collectionFactory;
    }

    /**
     * @return \Neklo\News\Model\ResourceModel\Category\CollectionFactory
     */
    public function getCollectionFactory()
    {
        return $this->collectionFactory;
    }
}
