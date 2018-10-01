<?php

namespace Neklo\News\Block\Adminhtml\Article\Button;

use Neklo\News\Block\Adminhtml\AbstractElements\Button\AbstractBase;

class Back extends AbstractBase
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
