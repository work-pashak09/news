<?php

namespace Neklo\News\Observer;

use Magento\Framework\Event\Observer as EventObserver;
use Magento\Framework\Data\Tree\Node;
use Magento\Framework\Event\ObserverInterface;

class AddLinkInMenu implements ObserverInterface
{

    public function execute(EventObserver $observer)
    {
        $menu = $observer->getMenu();
        $tree = $menu->getTree();
        $data = [
            'name' => __('Links on news'),
            'id' => 'some-unique-id-here',
            'url' => 'block'
        ];
        $node = new Node($data, 'id', $tree, $menu);
        $menu->addChild($node);
        return $this;
    }
}
