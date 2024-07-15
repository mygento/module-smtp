<?php

/**
 * @author Mygento Team
 * @copyright 2023 Mygento (https://www.mygento.com)
 * @package Mygento_Smtp
 */

namespace Mygento\Smtp\Model;

use Magento\Framework\App\Config\ScopeConfigInterface;

class Config
{
    private const XML_PATH_EMAIL_LOG = 'system/smtp/log';
    private const XML_PATH_CLEAN_EMAIL_PERIOD = 'system/smtp/clean_email_period';
    private const XML_PATH_BLACKLIST = 'system/smtp/blacklist';

    public function __construct(
        private ScopeConfigInterface $scopeConfig
    ) {
    }

    /**
     * @return bool
     */
    public function isEnabled(): bool
    {
        return $this->scopeConfig->isSetFlag(self::XML_PATH_EMAIL_LOG);
    }

    /**
     * @return string|null
     */
    public function getCleanEmailPeriod(): ?string
    {
        return $this->scopeConfig->getValue(self::XML_PATH_CLEAN_EMAIL_PERIOD);
    }

    /**
     * @return string|null
     */
    public function getBlacklist(): ?string
    {
        return $this->scopeConfig->getValue(self::XML_PATH_BLACKLIST);
    }
}
