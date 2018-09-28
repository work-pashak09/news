<?php

namespace Neklo\News\Block\Adminhtml\Category\Button;

use Neklo\News\Block\Adminhtml\AbstractElements\Button\AbstractBase;

class Back extends AbstractBase
{
    public function getButtonData()
    {
        return [
            'label' => __('Back'),
            'url' => $this->getUrl('news/category'),
            'class' => 'back'
        ];
    }
}
