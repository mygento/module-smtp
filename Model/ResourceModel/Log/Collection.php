<?php

/**
 * @author Mygento Team
 * @copyright 2023 Mygento (https://www.mygento.com)
 * @package Mygento_Smtp
 */

namespace Mygento\Smtp\Model\ResourceModel\Log;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Mygento\Smtp\Model\Log;
use Mygento\Smtp\Model\ResourceModel\Log as LogResource;

class Collection extends AbstractCollection
{
    /** @var string */
    protected $_idFieldName = LogResource::TABLE_PRIMARY_KEY;

    /**
     * Define resource model
     */
    protected function _construct()
    {
        $this->_init(
            Log::class,
            LogResource::class,
        );
    }
}
