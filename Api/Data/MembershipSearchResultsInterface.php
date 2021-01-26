<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Eagle\Membership\Api\Data;

use Magento\Framework\Api\SearchResultsInterface;

/**
 * Interface for cms block search results.
 * @api
 * @since 100.0.2
 */
interface MembershipSearchResultsInterface extends SearchResultsInterface
{
    /**
     * Get blocks list.
     *
     * @return \Eagle\Membership\Api\Data\MembershipInterface[]
     */
    public function getItems();

    /**
     * Set blocks list.
     *
     * @param \Eagle\Membership\Api\Data\MembershipInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
