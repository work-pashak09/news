<?php

namespace Neklo\News\Block\Adminhtml\Category\Button;

use Neklo\News\Block\Adminhtml\AbstractElements\AbstractBase;

class AddCategory extends AbstractBase
{
    const ADMIN_RESOURCE = 'Neklo_News::category_save';

    /**
     * @return array
     */
    public function getButtonData()
    {
        $data = [];
        if ($this->isAllowed()) {
            $data = [
                'label' => __('Add Categories'),
                'class' => 'save primary',
                'data_attribute' => [
                    'mage-init' => ['button' => ['event' => 'save']],
                    'form-role' => 'save',
                ],
                'url' => 'news/category/newAction',
                'sort_order' => 90,
            ];
        }
        return $data;
    }
}
