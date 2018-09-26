<?php
/**
 * Created by PhpStorm.
 * User: php
 * Date: 14.09.18
 * Time: 13:53
 */

namespace Neklo\News\Model\ResourceNews\Categories;



use Neklo\News\Model\Categories as DataModel;
use Neklo\News\Model\ResourceNews\Categories as ResourseModel;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * Define resource model
     *
     * @return void
     */

    protected function _construct()
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