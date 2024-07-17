<?php

/**
 * @author Mygento Team
 * @copyright 2023 Mygento (https://www.mygento.com)
 * @package Mygento_Smtp
 */

namespace Mygento\Smtp\Model\Mail;

use Magento\Framework\Mail\EmailMessageInterface;
use Mygento\Smtp\Model\Config;

class Validator
{
    public function __construct(
        private Config $config,
    ) {
    }

    public function isValid(EmailMessageInterface $message): bool
    {
        return !$this->inBlacklist($message);
    }

    private function inBlacklist(EmailMessageInterface $message): bool
    {
        $blacklist = $this->config->getBlacklist();

        if (!$blacklist) {
            return false;
        }

        $recipient = $this->getRecipient($message);
        $patterns = array_unique(explode(PHP_EOL, $blacklist));
        foreach ($patterns as $pattern) {
            if (preg_match($pattern, $recipient)) {
                return true;
            }
        }

        return false;
    }

    private function getRecipient(EmailMessageInterface $message): string
    {
        $emails = [];
        if ($message->getTo()) {
            foreach ($message->getTo() as $address) {
                $emails[] = $address->getEmail();
            }
        }

        return implode(',', $emails);
    }
}
