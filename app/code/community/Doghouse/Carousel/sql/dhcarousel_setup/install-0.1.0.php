<?php

$installer = $this;
$installer->startSetup();

$table = $installer->getConnection()
    ->newTable($installer->getTable('dhcarousel/item'))
    ->addColumn('id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity'  => true,
        'unsigned'  => true,
        'nullable'  => false,
        'primary'   => true,
        ), 'Item ID')
    ->addColumn('name', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
        'nullable'  => false,
        ), 'Name')
    ->addColumn('label', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
        'nullable'  => false,
        ), 'Label')
    ->addColumn('url', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(
        ), 'Url')
    ->addColumn('image', Varien_Db_Ddl_Table::TYPE_TEXT, Varien_Db_Ddl_Table::DEFAULT_TEXT_SIZE, array(
        ), 'Carousel Image')
    ->addColumn('item_order', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'default'   => 0,
        ), 'Order')
    ->addColumn('created_at', Varien_Db_Ddl_Table::TYPE_DATETIME, null, array(
        'nullable'  => false,
        'default'   => '0000-00-00 00:00:00',
        ), 'Created At')
    ->addColumn('updated_at', Varien_Db_Ddl_Table::TYPE_DATETIME, null, array(
        'nullable'  => false,
        'default'   => '0000-00-00 00:00:00',
        ), 'Updated At')
    ->setComment('Doghouse Carousel Items');

$installer->getConnection()->createTable($table);

$installer->endSetup();
