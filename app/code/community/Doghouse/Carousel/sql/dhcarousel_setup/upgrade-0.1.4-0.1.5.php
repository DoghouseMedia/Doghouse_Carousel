<?php

$installer = $this;
$installer->startSetup();

// Add Date From
$installer->getConnection()->addColumn(
  $installer->getTable('dhcarousel/item'),
  'from_date',
  array(
    'TYPE'      => Varien_Db_Ddl_Table::TYPE_DATETIME,
    'NULLABLE'  => true,
    'COMMENT'   => 'Date From',
    'AFTER'     => 'image'
  )
);

// Add Date To
$installer->getConnection()->addColumn(
    $installer->getTable('dhcarousel/item'),
    'to_date',
    array(
        'TYPE'      => Varien_Db_Ddl_Table::TYPE_DATETIME,
        'NULLABLE'  => true,
        'COMMENT'   => 'Date To',
        'AFTER'     => 'image'
    )
);


$installer->endSetup();
