<?php

/**
 * @author Mygento Team
 * @copyright 2023 Mygento (https://www.mygento.com)
 * @package Mygento_Smtp
 */

namespace Mygento\Smtp\Mail;

use Closure;
use Magento\Framework\Exception\MailException;
use Magento\Framework\Mail\EmailMessageInterface;
use Magento\Framework\Mail\TransportInterface;
use Mygento\Smtp\Model\Config;
use Mygento\Smtp\Model\Mail\Processor;
use Mygento\Smtp\Model\Mail\Validator;

class Transport
{
    public function __construct(
        private Processor $mailProcessor,
        private Validator $blackListValidator,
        private Config $config,
    ) {
    }

    /**
     * @param TransportInterface $subject
     * @param Closure $proceed
     * @throws MailException
     * @return void
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function aroundSendMessage(TransportInterface $subject, Closure $proceed): void
    {
        if (!$this->config->isEnabled()) {
            $proceed();

            return;
        }
        /** @var EmailMessageInterface $message */
        $message = $subject->getMessage();

        if (!$this->blackListValidator->isValid($message)) {
            return;
        }

        $this->mailProcessor->process($proceed, $message);
    }
}
