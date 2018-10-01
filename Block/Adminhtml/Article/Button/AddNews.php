<?php

namespace Neklo\News\Block\Adminhtml\Article\Button;

use Neklo\News\Block\Adminhtml\AbstractElements\Button\AbstractBase;

class AddNews extends AbstractBase
{
    const ADMIN_RESOURCE = 'Neklo_News::save';

    /**
     * @return array
     */
    public function getButtonData()
    {
        $data = [];
        if ($this->isAllowed()) {
                $data = [
                    'label' => __('Add News'),
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
