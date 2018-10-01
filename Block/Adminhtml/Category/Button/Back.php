<?php

namespace Neklo\News\Block\Adminhtml\Category\Button;

use Neklo\News\Block\Adminhtml\AbstractElements\AbstractBase;

class Back extends AbstractBase
{
    /**
     * @return array
     */
    public function getButtonData()
    {
        return [
            'label' => __('Back'),
            'url' => $this->getUrl('news/category'),
            'class' => 'back'
        ];
    }
}
