<?php

/**
 * @author Mygento Team
 * @copyright 2023 Mygento (https://www.mygento.com)
 * @package Mygento_Smtp
 */

namespace Mygento\Smtp\Model;

use Magento\Framework\Api\SearchResults;
use Mygento\Smtp\Api\Data\LogSearchResultsInterface;

class LogSearchResults extends SearchResults implements LogSearchResultsInterface {}
