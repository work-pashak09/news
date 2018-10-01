<?php

namespace Neklo\News\Setup;

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface
{
    /** @var \Neklo\News\Model\ArticleFactory  */
    private $newsFactory;
    /** @var \Neklo\News\Model\CategoryFactory  */
    private $catFactory;

    public function __construct(
       \Neklo\News\Model\ArticleFactory $newsFactory,
        \Neklo\News\Model\CategoryFactory $catFactory
    ) {
        $this->newsFactory = $newsFactory;
        $this->catFactory = $catFactory;
    }

    public function install(
        ModuleDataSetupInterface $setup,
        ModuleContextInterface $context
    ) {
        $data = [
            [
                'category' => "sport",
                'is_active' => "1",
            ],
            [
                'category' => "crash",
                'is_active' => "1",
            ],
            [
                'category' => "policy",
                'is_active' => "1",
            ],
        ];
        foreach ($data as $val) {
            $catFact = $this->catFactory->create();
            $catFact->addData($val)->save();
        }

        $data = [
            [
                'category_id' => "1",
                'url_key' => "my-stort",
                'title' => "sports",
                'content' => "sports sports sports",
                'is_active' => "1"
            ],
            [
                'category_id' => "2",
                'url_key' => "my-crush",
                'title' => "crush",
                'content' => "crush crush crush",
                'is_active' => "1"
            ],
            [
                'category_id' => "3",
                'url_key' => "my-policy",
                'title' => "policy",
                'content' => "policy policy policy",
                'is_active' => "1"
            ]
        ];
        foreach ($data as $val) {
            $newsFact = $this->newsFactory->create();
            $newsFact->addData($val)->save();
        }
    }
}
