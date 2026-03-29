<?php

/**
 * @author Mygento Team
 * @copyright 2023 Mygento (https://www.mygento.com)
 * @package Mygento_Smtp
 */

namespace Mygento\Smtp\Cron;

use Magento\Framework\Stdlib\DateTime;
use Mygento\Smtp\Model\Config;
use Mygento\Smtp\Model\ResourceModel;

class Clean
{
    public function __construct(
        private Config $config,
        private ResourceModel\Log $resource,
        private DateTime $dateTime,
        private DateTime\DateTime $date,
    ) {}

    public function execute()
    {
        $clearDays = (int) $this->config->getCleanEmailPeriod();

        if (!$this->config->isEnabled() || $clearDays <= 0) {
            return;
        }

        $connection = $this->resource->getConnection();
        $condition = $connection->quoteInto(
            'created_at <= ?',
            $this->dateTime->formatDate($this->date->gmtTimestamp() - $clearDays * 24 * 60 * 60),
        );
        $connection->delete($this->resource->getMainTable(), $condition);
    }
}
