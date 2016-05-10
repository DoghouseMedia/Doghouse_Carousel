<?php

$installer = $this;

$installer->startSetup();

// Create a default group, assign all existing carousel images to it
try {
    $defaultGroup = Mage::getModel('dhcarousel/group')
        ->setName('Default')
        ->setIdentifier('default')
        ->save();

    $items = Mage::getModel('dhcarousel/item')->getCollection();

    foreach ($items as $item) {
        $item
            ->setGroupId($defaultGroup->getId())
            ->save();
    }
} catch (Exception $e) {
    Mage::logException($e);
    throw $e;
}

$installer->endSetup();
