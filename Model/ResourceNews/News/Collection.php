<?php



namespace Neklo\News\Model\ResourceNews\News;

use Neklo\News\Model\News as DataModel;
use Neklo\News\Model\ResourceNews\News as ResourseModel;

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

    private function addCategoryData()
    {
        $this->join(
            ['cat' => $this->getTable('neklo_news_category')],
            'main_table.category_id = cat.id',
            [
                'aaaa' => 'cat.category'
            ]
        );
        return $this;
    }
}
