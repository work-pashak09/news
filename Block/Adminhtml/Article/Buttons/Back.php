<?php
/**
 * Created by PhpStorm.
 * User: php
 * Date: 18.09.18
 * Time: 14:02
 */

namespace Neklo\News\Block\Adminhtml\Article\Buttons;

use Neklo\News\Block\Adminhtml\AbstractElements\Button\AbstractBaseButton;

class Back extends AbstractBaseButton
{

    public function getButtonData()
    {

        return [
                'label' => __('Back'),
                'url' => $this->getUrl('news'),
                'class' => 'back'
            ];
    }
}
