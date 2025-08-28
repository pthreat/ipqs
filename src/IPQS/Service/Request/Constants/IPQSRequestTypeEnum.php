<?php

declare(strict_types=1);

namespace IPQS\Service\Request\Constants;

enum IPQSRequestTypeEnum : string
{
    case DEVICE      = 'devicetracker';
    case FRAUD       = 'fraud';
    case EMAIL       = 'email';
    case PHONE       = 'phone';
    case URL         = 'url';
    case LEAKED      = 'leaked';
    case PROXY       = 'proxy';
    case CREDIT_CARD = 'credit_card';
    case TRANSACTION = 'transaction';

    /**
     * @throws \InvalidArgumentException
     */
    public static function fromName(string $name): self
    {
        foreach (self::cases() as $status) {
            if ($name === $status->name) {
                return $status;
            }
        }
        throw new \InvalidArgumentException("$name is not a valid backing name for enum ".self::class);
    }

    /**
     * @throws \InvalidArgumentException
     */
    public static function fromValue(string $value): self
    {
        foreach (self::cases() as $status) {
            if ($value === $status->value) {
                return $status;
            }
        }
        throw new \InvalidArgumentException("$value is not a valid backing value for enum ".self::class);
    }
}
