<?php

namespace AHT\Example2\Model;

use AHT\Example2\Api\Data\BlogPostInterface;

class BlogPost extends \Magento\Framework\Model\AbstractModel implements \Magento\Framework\DataObject\IdentityInterface, BlogPostInterface
{
    const CACHE_TAG = 'aht_blog_post';
    protected $_cacheTag = 'aht_blog_post';
    protected $_eventPrefix = 'aht_blog_post';

    protected function _construct()
    {
        $this->_init('AHT\Example2\Model\ResourceModel\BlogPost');
    }

    public function getIdentities()
    {
        // TODO: Implement getIdentities() method.
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    public function getDefaultValues()
    {
        $values = [];
        return $values;
    }
}
