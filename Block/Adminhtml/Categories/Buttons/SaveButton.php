<?php

namespace Neklo\News\Block\Adminhtml\Categories\Buttons;

use Neklo\News\Block\Adminhtml\AbstractElements\Button\AbstractBaseButton;

/**
 * Class SaveButton
 */
class SaveButton extends AbstractBaseButton
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
                'label' => __('Save'),
                'class' => 'save primary',
                'data_attribute' => [
                    'mage-init' => ['button' => ['event' => 'save']],
                    'form-role' => 'save',
                ],
                'sort_order' => 10,
            ];
        }
        return $data;
    }
}
