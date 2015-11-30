<?php
/**
 * Doghouse_Carousel_Block_Carousel
 *
 * @category  Doghouse
 * @package   Doghouse_Carousel
 * @author    Doghouse <support@dhmedia.com.au>
 * @copyright 2015 Doghouse Media (http://doghouse.agency)
 * @license   https://github.com/DoghouseMedia/Doghouse_Carousel/blob/master/LICENSE  The MIT License (MIT)
 * @link      https://github.com/DoghouseMedia/Doghouse_Carousel
 */
class Doghouse_Carousel_Block_Carousel
    extends Mage_Catalog_Block_Product_Abstract
    implements Mage_Widget_Block_Interface
{

    /**
     * Cache group Tag.
     */
    const CACHE_GROUP = 'block_dhm_carousel';

    /**
     * Prepare carousel.
     *
     * Placeholder function to add js/css to the top of the page.
     * Only works if it's an instance widget or inserted into the layout the normal way.
     * If it's a widget, you add {{widget type="dhcarousel/carousel"}} to a CMS page.
     */
    protected function _prepareLayout()
    {

        //Place your own stuffz.
        /*if ($head = $this->getLayout()->getBlock('head')) {
            $head->addCss('myfile.css');
            $head->addItem('skin_js','jquery/testjs.js');
        }*/
        return parent::_prepareLayout();
    }

    /**
     * Construct the carousel block.
     */
    protected function _construct()
    {

        //Want to change/override this? No problem. Override this block, override the constructor,
        //OR, if using it as a widget, create a config so you can specify what template you want to use
        $this->setTemplate('doghouse/carousel/carousel.phtml');
        $this->setCacheLifetime(3600);

        return parent::_construct();
    }

    /**
     * Get carousel items.
     *
     * @param null $identifier
     * @param bool $withProducts
     * @param bool $withInactive
     * @param bool $withSchedule
     * @param bool $withLimit
     * @return mixed
     */
    public function getCarouselItems(
        $identifier = null, $withProducts = false, $withInactive = false,
        $withSchedule = false, $withLimit = false
    ) {

        if (!$identifier) {
            $identifier = $this->getGroupIdentifier();
        }

        $group = Mage::getModel('dhcarousel/group')->load($identifier, 'identifier');

        $collection = Mage::getModel('dhcarousel/item')
            ->getCollection()
            ->addFieldToFilter('group_id', $group->getId());

        if (!$withInactive) {
            $collection->addFieldToFilter('active', 1);
        }

        //passed by reference, so it affects the collection
        $collection->getSelect()->order('item_order', 'ASC');

        if ($withProducts) {
            $this->addProductsToCollection($collection);
        }

        if ($withSchedule) {

            $todayStartOfDayDate = Mage::app()->getLocale()->date()
                ->setTime('00:00:00')
                ->toString(Varien_Date::DATETIME_INTERNAL_FORMAT);

            $todayEndOfDayDate = Mage::app()->getLocale()->date()
                ->setTime('23:59:59')
                ->toString(Varien_Date::DATETIME_INTERNAL_FORMAT);

            $collection->addFieldToFilter(
                'from_date', array('or' => array(
                    0 => array('date' => true, 'to' => $todayEndOfDayDate),
                    1 => array('is' => new Zend_Db_Expr('null'))
                )), 'left'
            );

            $collection->addFieldToFilter(
                'to_date', array('or' => array(
                        0 => array('date' => true, 'from' => $todayStartOfDayDate),
                        1 => array('is' => new Zend_Db_Expr('null'))
                )), 'left'
            );

        }

        if ($withLimit && is_integer($withLimit)) {
            $collection->getSelect()->limit($withLimit);
        }

        return $collection;
    }

    /**
     * Get carousel Group identifier.
     *
     * @return string
     */
    public function getGroupIdentifier()
    {
        if (parent::getGroupIdentifier()) {
            return parent::getGroupIdentifier();
        }

        return 'default';
    }

    /**
     * Adds products to carousel item collection.
     *
     * @param $collection
     */
    public function addProductsToCollection($collection)
    {
        $productIds = array_map(
            function ($item) {
                if ($item->getProductId() > 0) {
                    return $item->getProductId();
                }
            }, $collection->getItems()
        );

        $products = Mage::getModel('catalog/product')
            ->getCollection()
            ->addFieldToFilter('entity_id', array('in' => array_values($productIds)));

        Mage::getSingleton('catalog/layer')->prepareProductCollection($products);
        Mage::getSingleton('cataloginventory/stock')->addInStockFilterToCollection($products);

        foreach ($collection as $item) {
            $item->setProduct($products->getItemById($item->getProductId()));
        }
    }

    /**
     * Get cache key informative items
     * Concat the group name to the cache key.
     *
     * This will allow for clearing of specific cached carousels
     *
     * @return array
     */
    public function getCacheKeyInfo()
    {
        return array(
            self::CACHE_GROUP . '_' . $this->getGroupIdentifier(),
            Mage::app()->getStore()->getCode(),
            $this->getTemplateFile(),
            'template' => $this->getTemplate()
        );
    }

    /**
     * Set the cache tag to be this carousel specific
     *
     * @return array
     */
    public function getCacheTags()
    {
        $tags = array(self::CACHE_GROUP . '_' . $this->getGroupIdentifier(),
                      self::CACHE_GROUP);

        return $tags;
    }


}