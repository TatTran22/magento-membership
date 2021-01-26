<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Eagle\Membership\Api\Data;

/**
 * CMS block interface.
 * @api
 * @since 100.0.2
 */
interface MembershipInterface
{
    /**#@+
     * Constants for keys of data array. Identical to the name of the getter in snake case
     */
    const MEMBERSHIP_ID      = 'membership_id';
    const NAME    = 'name';
    const DESCRIPTION         = 'description';
    const DISCOUNT       = 'discount';
    const DISCOUNT_TYPE = 'discount_type';
    const STATUS     = 'status';
    /**#@-*/

    /**
     * Get ID
     *
     * @return int|null
     */
    public function getId();

    /**
     * Get identifier
     *
     * @return string
     */
    public function getName();

    /**
     * Get title
     *
     * @return string|null
     */
    public function getDescription();

    /**
     * Get content
     *
     * @return string|null
     */
    public function getDiscount();

    /**
     * Get update time
     *
     * @return string|null
     */
    public function getDiscountType();

    /**
     * Is active
     *
     * @return bool|null
     */
    public function getStatus();

    /**
     * Set ID
     *
     * @param int $id
     * @return MembershipInterface
     */
    public function setId($id);

    /**
     * Set identifier
     *
     * @param string $name
     * @return MembershipInterface
     */
    public function setName($name);

    /**
     * Set title
     *
     * @param string $description
     * @return MembershipInterface
     */
    public function setDescription($description);

    /**
     * Set content
     *
     * @param number $discount
     * @return MembershipInterface
     */
    public function setDiscount($discount);


    /**
     * Set update time
     *
     * @param string $discountType
     * @return MembershipInterface
     */
    public function setDiscountType($discountType);

    /**
     * Set is active
     *
     * @param bool|int $status
     * @return MembershipInterface
     */
    public function setStatus($status);
}
