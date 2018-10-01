<?php

namespace Neklo\News\Block\Adminhtml\Article\Button;

use Neklo\News\Block\Adminhtml\AbstractElements\Button;

class Back extends Button
{
    /**
     * @return array
     */
    public function getButtonData()
    {
        return [
                'label' => __('Back'),
                'url' => $this->getUrl('news'),
                'class' => 'back'
            ];
    }
}
