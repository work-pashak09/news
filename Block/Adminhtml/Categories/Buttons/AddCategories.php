<?php

namespace Neklo\News\Block\Adminhtml\Categories\Buttons;

use Neklo\News\Block\Adminhtml\AbstractElements\Button\AbstractBaseButton;

class AddCategories extends AbstractBaseButton
{
    const ADMIN_RESOURCE = 'Neklo_News::save';

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
                'url' => 'news/categories/newAction',
                'sort_order' => 90,
            ];
        }

        return $data;
    }
}
