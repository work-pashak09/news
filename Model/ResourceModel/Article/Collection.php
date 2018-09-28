<?php

namespace Neklo\News\Model\ResourceModel\Article;

use Neklo\News\Model\Article as DataModel;
use Neklo\News\Model\ResourceModel\Article as ResourseModel;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    public function _construct()
    {
        $this->_init(DataModel::class, ResourseModel::class);
    }

    public function getDataArticle($urlArticle, $nameCategory)
    {
        return $this->join([
            'nnc' => 'neklo_news_category'
        ], 'main_table.category_id = nnc.id', [
            'nnc_is_active' => 'nnc.is_active',
            'main_is_active' => 'main_table.is_active',
            'nnc_category' => 'nnc.category'
        ])->addFieldToFilter('main_table.url_key', $urlArticle)
            ->addFieldToFilter('nnc.category', $nameCategory)
            ->getFirstItem();
    }

    public function getArticleById($id)
    {
        return $this->join(
            [
                'second' => 'neklo_news_category'
            ],
            'main_table.category_id = second.id'
        )->addFieldToFilter('main_table.id', $id);
    }

    public function getCollectionArticle()
    {
        return $this->join(
            [
                'nnc' => 'neklo_news_category'
            ],
            'main_table.category_id = nnc.id',
            [
                'nnc_is_activ' => 'nnc.is_active',
                'nnc_name_getegory' => 'nnc.category',
            ]
        );
    }
}
