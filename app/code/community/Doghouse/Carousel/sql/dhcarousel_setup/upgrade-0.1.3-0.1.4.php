<?php

$installer = $this;
$installer->startSetup();

// Add Tracking code column to dhcarousel_item table
$installer->getConnection()->addColumn(
  $installer->getTable('dhcarousel/item'),
  'gtm_event_code',
  array(
    'TYPE'      => Varien_Db_Ddl_Table::TYPE_TEXT,
    'UNSIGNED'  => true,
    'NULLABLE'  => false,
    'COMMENT'   => 'GTM Event Tracking',
    'AFTER'     => 'image'
  )
);

$installer->endSetup();
