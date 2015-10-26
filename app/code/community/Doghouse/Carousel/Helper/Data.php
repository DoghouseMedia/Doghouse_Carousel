<?php

class Doghouse_Carousel_Helper_Data extends Mage_Core_Helper_Abstract
{

    const MEDIA_DIR = 'dhcarousel/';

    /**
     * With http:// and everything
     *
     * @return [string] url
     */
    public function getImageUrl()
    {
        return Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA) . self::MEDIA_DIR;
    }

    /**
     * Get the directory, so /media/carousel/
     *
     * @return [string] uri
     */
    public function getFullImagesDir()
    {
        return Mage::getBaseDir('media') . DS . self::MEDIA_DIR;
    }

    /**
     * Does some saving action
     *
     * @param  [type] $name name of the input field
     *
     * @return [string | false] filename or false on exception
     */
    public function saveImage($name)
    {
        $path = $this->getFullImagesDir();

        try {
            $uploader = new Mage_Core_Model_File_Uploader($name);
            $uploader->setAllowedExtensions(array('jpg', 'jpeg', 'gif', 'png'));
            $uploader->setAllowRenameFiles(true);
            $result = $uploader->save($path);

            return $result['file'];

        } catch (Exception $e) {
            if ($e->getCode() != Mage_Core_Model_File_Uploader::TMP_NAME_EMPTY) {
                Mage::logException($e);
            }

            return;
        }
    }

    /**
     * Formats a nicely formatted Image url
     *
     * @param  Doghouse_Carousel_Model_Item $item [description]
     *
     * @return [String] url
     */
    public function getImage(Doghouse_Carousel_Model_Item $item)
    {
        return $this->getImageUrl() . $item->getImage();
    }

    /**
     * Formats a nicely formatted url. Aw yeah.
     *
     * @param  Doghouse_Carousel_Model_Item $item [description]
     *
     * @return [String] url
     */
    public function getUrl(Doghouse_Carousel_Model_Item $item)
    {
        return Mage::getUrl($item->getUrl());
    }

    /**
     * Clear out the cache entries for the given tags
     *
     * @param $tags
     *
     * @return $this
     */
    public function clearCache(array $tags = array())
    {
        $cache = Mage::app()->getCacheInstance();
        if (is_object($cache)) {
            $cache->clean($tags);
            if (Mage::app()->useCache('full_page')) {
                Mage::dispatchEvent(
                    'adminhtml_cache_refresh_type', array('type' => Doghouse_Carousel_Block_Carousel::CACHE_GROUP)
                );
            }
        }

        return $this;
    }

}
