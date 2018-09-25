<?php

namespace Neklo\News\Observer;

use Magento\Framework\Event\Observer as EventObserver;
use Magento\Framework\Data\Tree\Node;
use Magento\Framework\Event\ObserverInterface;

class AddLinkInMenu implements ObserverInterface
{
    private $config;

    public function __construct(
        \Neklo\News\Helper\Config $config
    ) {
        $this->config = $config;
    }

    public function execute(EventObserver $observer)
    {
        if ($this->config->isActivUrlInMavigation()) {
            $menu = $observer->getMenu();
            $tree = $menu->getTree();
            $data = [
                'name' => __($this->config->getNameUrlInMavigation()),
                'id' => 'some-unique-id-here',
                'url' => 'block'
            ];
            $node = new Node($data, 'id', $tree, $menu);
            $menu->addChild($node);
        }
        return $this;
    }
}
