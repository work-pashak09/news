<?php
/**
 * Created by PhpStorm.
 * User: php
 * Date: 07.09.18
 * Time: 13:35
 */

namespace Neklo\News\Block\Adminhtml\Categories\Buttons;

use Neklo\News\Block\Adminhtml\AbstractElements\Button\AbstractBaseButton;

class DeleteButton extends AbstractBaseButton
{
    const ADMIN_RESOURCE = 'Neklo_News::delete';

    /**
     * Retrieve button-specified settings
     *
     * @return array
     */
    public function getButtonData()
    {

        $id = $this->getRegistry()->registry('id');
        $data  =[];
        if ($id && $this->isAllowed()) {
            $data = [
                'label' => __('Delete Categories'),
                'class' => 'del',
                'on_click' => 'deleteConfirm(\'' . __(
                    'Are you sure you want to do this?'
                ) . '\', \'' . $this->getUrl('*/*/del', ['id' => $id]) . '\')',
                'sort_order' => 20,
            ];
        }
        return $data;
    }
}
