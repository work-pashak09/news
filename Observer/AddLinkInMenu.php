<?php

namespace Neklo\News\Observer;

use Magento\Framework\Event\Observer as EventObserver;
use Magento\Framework\Event\ObserverInterface;

class AddLinkInMenu implements ObserverInterface
{
    private $config;
    private $observer;

    public function __construct(
        \Neklo\News\Helper\Config $config,
        \Magento\Framework\Data\Tree\NodeFactory $node
    ) {
        $this->config = $config;
        $this->observer = $node;
    }

    public function execute(EventObserver $observer)
    {
        if ($this->config->isShowUrlInNavigation()) {
            $menu = $observer->getMenu();
            $tree = $menu->getTree();
            $data = [
                'name' => __($this->config->getNameUrlInNavigation()),
                'id' => 'some-unique-id-here',
                'url' => 'block'
            ];
            $node = $this->observer->create([
                'data' => $data,
                'idField' => 'id',
                'tree' => $tree,
                'menu' => $menu
            ]);
            $menu->addChild($node);
        }
        return $this;
    }
}
