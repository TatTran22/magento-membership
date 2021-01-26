<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
declare(strict_types=1);

namespace Eagle\Membership\Model;

use Eagle\Membership\Api\Data\MembershipSearchResultsInterface;
use Magento\Framework\Api\SearchResults;

/**
 * Service Data Object with Membership search results.
 */
class MembershipSearchResults extends SearchResults implements MembershipSearchResultsInterface
{
}
