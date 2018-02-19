<?php
namespace ASI\SomeAPI\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;

class UpgradeSchema implements UpgradeSchemaInterface
{
    public function upgrade( SchemaSetupInterface $setup, ModuleContextInterface $context ) {
        $installer = $setup;
        $installer->startSetup();

        $table_name = 'bearer_tokens';//TODO name tabel in config

        if(version_compare($context->getVersion(), '1.1.0', '<')) {
            if (!$installer->tableExists($table_name)) {
                $table = $installer->getConnection()->newTable(
                    $installer->getTable($table_name)
                )
                    ->addColumn(
                        'bearer_token_id',
                        \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
                        null,
                        [
                            'identity' => true,
                            'nullable' => false,
                            'primary'  => true,
                            'unsigned' => true,
                        ]
                    )
                    ->addColumn(
                        'value',
                        \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
                        255,
                        ['nullable => false']
                    );
                $installer->getConnection()->createTable($table);

                $installer->getConnection()->addIndex(
                    $installer->getTable($table_name),
                    $setup->getIdxName(
                        $installer->getTable($table_name),
                        ['value'],
                        \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
                    ),
                    ['value'],
                    \Magento\Framework\DB\Adapter\AdapterInterface::INDEX_TYPE_FULLTEXT
                );
            }
        }

        $installer->endSetup();
    }
}