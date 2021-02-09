<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Eagle\Membership\Model;

use Eagle\Membership\Api\Data\MembershipInterface;
use Magento\Framework\DataObject\IdentityInterface;
use Magento\Framework\Model\AbstractModel;

/**
 * CMS block model
 *
 * @method Membership setMembershipId(int $membershipId)
 * @method int getMembershipId()
 */
class Membership extends AbstractModel implements MembershipInterface
{
    /**
     * CMS block cache tag
     */
    const CACHE_TAG = 'cms_b';

    /**#@+
     * Membership's statuses
     */
    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 0;

    /**#@-*/

    /**#@-*/
    protected $_cacheTag = self::CACHE_TAG;

    /**
     * Prefix of model events names
     *
     * @var string
     */
    protected $_eventPrefix = 'membership_block';

    /**
     * Construct.
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(\Eagle\Membership\Model\ResourceModel\Index::class);
    }

    /**
     * Retrieve block id
     *
     * @return int
     */
    public function getId()
    {
        return $this->getData(self::MEMBERSHIP_ID);
    }

    /**
     * Retrieve block identifier
     *
     * @return string
     */
    public function getName()
    {
        return (string)$this->getData(self::NAME);
    }


    public function getDescription()
    {
        return $this->getData(self::DESCRIPTION);
    }


    public function getDiscount()
    {
        return $this->getData(self::DISCOUNT);
    }


    public function getDiscountType()
    {
        return $this->getData(self::DISCOUNT_TYPE);
    }

    public function getStatus(): bool
    {
        return (bool)$this->getData(self::STATUS);
    }


    public function setId($id)
    {
        return $this->setData(self::MEMBERSHIP_ID, $id);
    }

    /**
     * Set identifier
     *
     * @param string $name
     * @return MembershipInterface
     */
    public function setName($name)
    {
        return $this->setData(self::NAME, $name);
    }

    /**
     * Set title
     *
     * @param string $description
     * @return MembershipInterface
     */
    public function setDescription($description)
    {
        return $this->setData(self::DESCRIPTION, $description);
    }

    /**
     * Set content
     *
     * @param string $discount
     * @return MembershipInterface
     */
    public function setDiscount($discount)
    {
        return $this->setData(self::DISCOUNT, $discount);
    }


    /**
     * Set update time
     *
     * @param string $discountType
     * @return MembershipInterface
     */
    public function setDiscountType($discountType)
    {
        return $this->setData(self::DISCOUNT_TYPE, $discountType);
    }

    /**
     * Set is active
     *
     * @param bool|int $status
     * @return MembershipInterface
     */
    public function setStatus($status)
    {
        return $this->setData(self::STATUS, $status);
    }

    /**
     * Receive page store ids
     *
     * @return int[]
     */
    public function getMemberships()
    {
        return $this->hasData('membership') ? $this->getData('membership') : $this->getData('membership_id');
    }

    /**
     * Prepare block's statuses.
     *
     * @return array
     */
    public function getAvailableStatus()
    {
        return [self::STATUS_ENABLED => __('Enabled'), self::STATUS_DISABLED => __('Disabled')];
    }


}
