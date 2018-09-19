<?php

namespace Neklo\News\Controller\Adminhtml\Categories;

use Magento\Backend\App\Action;

class MassDelete extends \Neklo\News\Controller\Adminhtml\MassectionAction\AbstractMassDeleteItems
{
    private $collectionFactory;

    public function __construct(
        Action\Context $context,
        \Neklo\News\Model\ResourceNews\Categories\CollectionFactory $collectionFactory
    ) {
        parent::__construct($context);
        $this->collectionFactory = $collectionFactory;
    }

    public function getCollectionFactory()
    {
        return $this->collectionFactory;
    }
}
