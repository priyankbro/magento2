<?php
/**
 * Copyright © 2013-2017 Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\UrlRewrite\Model;

use Magento\Framework\App\ObjectManager;
use Magento\Framework\Serialize\SerializerInterface;

/**
 * @method int getEntityId()
 * @method string getEntityType()
 * @method int getRedirectType()
 * @method int getStoreId()
 * @method int getIsAutogenerated()
 * @method string getTargetPath()
 * @method UrlRewrite setEntityId(int $value)
 * @method UrlRewrite setEntityType(string $value)
 * @method UrlRewrite setRequestPath($value)
 * @method UrlRewrite setTargetPath($value)
 * @method UrlRewrite setRedirectType($value)
 * @method UrlRewrite setStoreId($value)
 * @method UrlRewrite setDescription($value)
 */
class UrlRewrite extends \Magento\Framework\Model\AbstractModel
{
    /**
     * @var SerializerInterface
     */
    private $serializer;

    /**
     * UrlRewrite constructor.
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Model\ResourceModel\AbstractResource|null $resource
     * @param \Magento\Framework\Data\Collection\AbstractDb|null $resourceCollection
     * @param array $data
     * @param SerializerInterface $serializer
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Model\ResourceModel\AbstractResource $resource = null,
        \Magento\Framework\Data\Collection\AbstractDb $resourceCollection = null,
        array $data = [],
        SerializerInterface $serializer = null
    ) {
        $this->serializer = $serializer ?: ObjectManager::getInstance()->get(SerializerInterface::class);
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }

    /**
     * Initialize corresponding resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(\Magento\UrlRewrite\Model\ResourceModel\UrlRewrite::class);
        $this->_collectionName = \Magento\UrlRewrite\Model\ResourceModel\UrlRewriteCollection::class;
    }

    /**
     * @return array
     * @api
     */
    public function getMetadata()
    {
        $metadata = $this->getData(\Magento\UrlRewrite\Service\V1\Data\UrlRewrite::METADATA);
        return !empty($metadata) ? $this->serializer->unserialize($metadata) : [];
    }

    /**
     * Overwrite Metadata in the object.
     *
     * @param array|string $metadata
     *
     * @return $this
     */
    public function setMetadata($metadata)
    {
        if (is_array($metadata)) {
            $metadata = $this->serializer->serialize($metadata);
        }
        return $this->setData(\Magento\UrlRewrite\Service\V1\Data\UrlRewrite::METADATA, $metadata);
    }
}
