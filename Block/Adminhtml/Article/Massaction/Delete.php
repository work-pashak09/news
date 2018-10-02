<?php

namespace Neklo\News\Block\Adminhtml\Article\Massaction;

use Neklo\News\Block\Adminhtml\AbstractElements\Massaction\Item;

class Delete extends Item
{
    const ADMIN_RESOURCE = 'Neklo_News::article_save';
    const  ACTION = 'delete';
}
