<?php

declare(strict_types=1);

namespace IPQS\Service\Device\Response;

use IPQS\Response\VerificationResponseTrait;

readonly class DeviceVerificationResponse implements DeviceVerificationResponseInterface
{
    use VerificationResponseTrait;

    public function isUnique(): bool|null
    {
        return $this->data['unique'] ?? null;
    }

    public function getIp(): string|null
    {
        return $this->data['ip'] ?? null;
    }

    public function getFingerprint(): string|null
    {
        return $this->data['id'] ?? null;
    }
}
