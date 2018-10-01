<?php

namespace Neklo\News\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class UpgradeSchema implements UpgradeSchemaInterface
{
    /**
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     */
    public function upgrade( SchemaSetupInterface $setup, ModuleContextInterface $context )
    {
        $setup->startSetup();
        $setup->endSetup();
    }
}
