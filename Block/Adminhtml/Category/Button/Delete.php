<?php

namespace Neklo\News\Block\Adminhtml\Category\Button;

use Neklo\News\Block\Adminhtml\AbstractElements\Button\AbstractBase;

class Delete extends AbstractBase
{
    const ADMIN_RESOURCE = 'Neklo_News::delete';

    public function getButtonData()
    {

        $id = $this->getRegistry()->registry('id');
        $data  =[];
        if ($id && $this->isAllowed()) {
            $data = [
                'label' => __('Delete select categories'),
                'class' => 'del',
                'on_click' => 'deleteConfirm(\'' . __(
                    'Are you sure you want to delete the selected categories?'
                ) . '\', \'' . $this->getUrl('*/*/del', ['id' => $id]) . '\')',
                'sort_order' => 20,
            ];
        }
        return $data;
    }
}