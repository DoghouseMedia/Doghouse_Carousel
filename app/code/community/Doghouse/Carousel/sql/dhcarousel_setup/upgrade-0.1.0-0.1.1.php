<?php

$installer = $this;
$installer->startSetup();

$installer->getConnection()->addColumn(
    $installer->getTable('dhcarousel/item'),
    'product_id',
    array(
        'TYPE'      => Varien_Db_Ddl_Table::TYPE_INTEGER,
        'UNSIGNED'  => true,
        'NULLABLE'  => true,
        'COMMENT'   => 'Associated product ID',
        'AFTER'     => 'image'
    )
);

$installer->endSetup();
