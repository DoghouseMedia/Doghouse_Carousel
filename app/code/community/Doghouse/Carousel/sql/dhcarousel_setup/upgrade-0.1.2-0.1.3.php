<?php

$installer = $this;
$installer->startSetup();

// Add active column to dhcarousel_item table
$installer->getConnection()->addColumn(
    $installer->getTable('dhcarousel/item'),
    'active',
    array(
        'TYPE'      => Varien_Db_Ddl_Table::TYPE_SMALLINT,
        'UNSIGNED'  => true,
        'NULLABLE'  => false,
        'DEFAULT'   => 0,
        'COMMENT'   => 'Active',
        'AFTER'     => 'image'
    )
);

$installer->endSetup();
