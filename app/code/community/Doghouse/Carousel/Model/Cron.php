<?php

/**
 * Cron functions
 *
 * @category      Doghouse
 * @package       Doghouse_Carousel
 * @author        Lucas van Staden (support@proxiblue.com.au)
 */
class  Doghouse_Carousel_Model_Cron
{

    /**
     * Clear the carousel cache daily.
     * This will allow the carousels to rebuild taking into account any changes on scheduled items in the carousel.
     * The next time it is viewed, a carousel will load the latest (in scheduled) items for display
     */
    public static function clearCache()
    {
        try {
            // use global tag, whuch will clear all carousels
            $tag = array(Doghouse_Carousel_Block_Carousel::CACHE_GROUP);
            mage::helper('dhcarousel')->clearCache($tag);
            // pageCache only listens to adminhtml requests to clear, so force it to clear
            if (Mage::app()->useCache('full_page')) {
                $fpc = mage::getModel('enterprise_pagecache/observer');
                if(is_object($fpc)) {
                    $fpc->cleanCache();
                }
            }
        } catch (Exception $e) {
            mage::logException($e);
        }
    }
}
