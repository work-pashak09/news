<?php

namespace Neklo\News\Block\Adminhtml\Article\Button;

use Neklo\News\Block\Adminhtml\AbstractElements\AbstractBase;

class AddArticle extends AbstractBase
{
    const ADMIN_RESOURCE = 'Neklo_News::article_save';
    /**
     * @return array
     */
    public function getButtonData()
    {
        $data = [];
        if ($this->isAllowed()) {
                $data = [
                    'label' => __('Add article'),
                    'class' => 'save primary',
                    'data_attribute' => [
                        'mage-init' => ['button' => ['event' => 'save']],
                        'form-role' => 'save',
                    ],
                    'url' =>'news/article/newAction',
                    'sort_order' => 90,
                ];
        }

            return $data;
    }
}
