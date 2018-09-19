<?php


namespace Neklo\News\Model\ResourceNews;


use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
/**
 * Class Snippet
 * @package Training\Vendor\Model\Resource
 */
class Categories extends AbstractDb
{
    public function __construct(
        \Magento\Framework\Model\ResourceModel\Db\Context $context
    )
    {
        parent::__construct($context);
    }

    protected function _construct()
    {
        $this->_init('cms_categories_news', 'id');
    }
}