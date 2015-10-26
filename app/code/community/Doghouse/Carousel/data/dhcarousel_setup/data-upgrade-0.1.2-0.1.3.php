<?php

$installer = $this;

$installer->startSetup();

try {

    $items = Mage::getModel('dhcarousel/item')->getCollection();

    foreach ($items as $item) {
        $item
            ->setActive(1)
            ->save();
    }

} catch (Exception $e) {
    Mage::logException($e);
    throw $e;
}

$installer->endSetup();
