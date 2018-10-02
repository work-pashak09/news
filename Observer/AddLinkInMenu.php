<?php

namespace Neklo\News\Observer;

use Magento\Framework\Event\Observer as EventObserver;
use Magento\Framework\Event\ObserverInterface;

class AddLinkInMenu implements ObserverInterface
{
    /**
     * @var \Neklo\News\Helper\Config
     */
    private $config;
    /**
     * @var \Magento\Framework\Data\Tree\NodeFactory
     */
    private $observer;

    /**
     * @param \Neklo\News\Helper\Config $config
     * @param \Magento\Framework\Data\Tree\NodeFactory $node
     */
    public function __construct(
        \Neklo\News\Helper\Config $config,
        \Magento\Framework\Data\Tree\NodeFactory $node
    ) {
        $this->config = $config;
        $this->observer = $node;
    }

    /**
     * @param EventObserver $observer
     * @return $this|void
     */
    public function execute(EventObserver $observer)
    {
        if ($this->config->isShowUrlInNavigation()) {
            $menu = $observer->getMenu();
            $tree = $menu->getTree();
            $data = [
                'name' => __($this->config->getNameNavigationUrl()),
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
