<?php

$installer = $this;
$installer->startSetup();

// Create dhcarousel_group table
$table = $installer->getConnection()
    ->newTable($installer->getTable('dhcarousel/group'))
    ->addColumn('id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity'  => true,
        'unsigned'  => true,
        'nullable'  => false,
        'primary'   => true,
        ), 'Group ID')
    ->addColumn('name', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
        'nullable'  => false,
        ), 'Name')
    ->addColumn('identifier', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
        'nullable'  => false,
        'unique'    => true
        ), 'Unique Identifier')
    ->addColumn('created_at', Varien_Db_Ddl_Table::TYPE_DATETIME, null, array(
        'nullable'  => false,
        'default'   => '0000-00-00 00:00:00',
        ), 'Created At')
    ->addColumn('updated_at', Varien_Db_Ddl_Table::TYPE_DATETIME, null, array(
        'nullable'  => false,
        'default'   => '0000-00-00 00:00:00',
        ), 'Updated At')
    ->setComment('Doghouse Carousel Groups');

$installer->getConnection()->createTable($table);

// Add group_id column to dhcarousel_item table
$installer->getConnection()->addColumn(
    $installer->getTable('dhcarousel/item'),
    'group_id',
    array(
        'TYPE'      => Varien_Db_Ddl_Table::TYPE_INTEGER,
        'UNSIGNED'  => true,
        'NULLABLE'  => true,
        'COMMENT'   => 'Group ID',
        'AFTER'     => 'product_id'
    )
);

// Add foreign key from dhcarousel_group to dhcarousel_item
$installer->getConnection()->addForeignKey(
    $installer->getFkName('dhcarousel/item', 'group_id', 'dhcarousel/group', 'id'),
    $installer->getTable('dhcarousel/item'),
    'group_id',
    $installer->getTable('dhcarousel/group'),
    'id',
    Varien_Db_Ddl_Table::ACTION_CASCADE,
    Varien_Db_Ddl_Table::ACTION_CASCADE
);

// Add foreign key from dhcarousel_item to catalog_product_entity
$installer->getConnection()->addForeignKey(
    $installer->getFkName('dhcarousel/item', 'product_id', 'catalog/product', 'entity_id'),
    $installer->getTable('dhcarousel/item'),
    'product_id',
    $installer->getTable('catalog/product'),
    'entity_id',
    Varien_Db_Ddl_Table::ACTION_SET_NULL,
    Varien_Db_Ddl_Table::ACTION_CASCADE
);


$installer->endSetup();
