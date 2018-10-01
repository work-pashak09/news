<?php

namespace Neklo\News\Model\ResourceModel\Category;

use Neklo\News\Model\Category as DataModel;
use Neklo\News\Model\ResourceModel\Category as ResourseModel;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    public function _construct()
    {
        $this->_init(DataModel::class, ResourseModel::class);
    }

    /**
     * Convert items array to array for select options
     *
     * @return array
     */
    public function toOptionArray()
    {
        return $this->_toOptionArray('id', 'category');
    }

    /**
     * Convert items array to hash for select options
     *
     * @return array
     */
    public function toOptionHash()
    {
        return $this->_toOptionHash('id', 'category');
    }
}
