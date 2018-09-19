<?php

namespace Neklo\News\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

class UpgradeSchema implements UpgradeSchemaInterface
{

    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();
        $connection = $setup->getConnection();

        if ($context->getVersion() && version_compare($context->getVersion(), '1.1.5') < 0) {

            $table = $connection
                ->newTable($setup->getTable('cms_categories_news'))
                ->addColumn(
                    'id',
                    \Magento\Framework\DB\Ddl\Table::TYPE_SMALLINT,
                    null,
                    ['identity' => true, 'nullable' => false, 'primary' => true]

                )->addColumn(
                    'categoria',
                    \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    255,
                    ['nullable' => false]
                );
              $connection->createTable($table);


               $connection->addColumn(
                $setup->getTable('cms_news'),
                'url_key',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                    'length' => 255,
                    'nullable' => true,
                    'default' => '',
                    'comment' => 'Address field'
                ]
            );
             $connection->addColumn(
                $setup->getTable('cms_news'),
                'categories_id',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    'nullable' => true,
                    'default' => null,
                    'afters' => 'id',
                    'comment' => 'id fild categories'
                ]
            );
        }
        if ($context->getVersion() && version_compare($context->getVersion(), '1.1.6') < 0) {
            $connection->addColumn(
                $setup->getTable('cms_categories_news'),
                'is_activ',
                [
                    'type' => \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                    'nullable' => false,
                    'default' => false,
                    'afters' => 'categoria',
                    'comment' => 'fild is_activ'
                ]
            );
        }

        $setup->endSetup();
    }
}
