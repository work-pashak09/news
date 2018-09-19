<?php

namespace Neklo\News\Block\Adminhtml\Article\Buttons;

use Neklo\News\Block\Adminhtml\AbstractElements\Button\AbstractBaseButton;

/**
 * Class SaveButton
 */
class AddNews extends AbstractBaseButton
{
    const ADMIN_RESOURCE = 'Neklo_News::save';


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
