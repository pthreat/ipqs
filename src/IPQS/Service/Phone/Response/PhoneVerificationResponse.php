<?php

declare(strict_types=1);

namespace IPQS\Service\Phone\Response;

use IPQS\Response\VerificationResponseTrait;

readonly class PhoneVerificationResponse  implements PhoneVerificationResponseInterface
{
    use VerificationResponseTrait;

    public function getFormatted(): string|null
    {
        return $this->data['formatted'] ?? null;
    }

    public function getLocalFormat(): string|null
    {
        return $this->data['local_format'] ?? null;
    }

    public function isVoip(): bool|null
    {
        return $this->data['VOIP'] ?? null;
    }

    public function isPrepaid(): bool|null
    {
        return $this->data['prepaid'] ?? null;
    }

    public function isRisky(): bool|null
    {
        return $this->data['risky'] ?? null;
    }

    public function isActive(): bool|null
    {
        return $this->data['active'] ?? null;
    }

    public function getName(): string|null
    {
        return $this->data['name'] ?? null;
    }

    public function getCarrier(): string|null
    {
        return $this->data['carrier'] ?? null;
    }

    public function getLineType(): string|null
    {
        return $this->data['line_type'] ?? null;
    }

    public function getCountry(): string|null
    {
        return $this->data['country'] ?? null;
    }

    public function getRegion(): string|null
    {
        return $this->data['region'] ?? null;
    }

    public function getAssociatedEmailAddresses(): array|null
    {
        return $this->data['associated_email_addresses'] ?? null;
    }

    public function isLeaked(): bool|null
    {
        return $this->data['leaked'] ?? null;
    }

    public function isValid(): bool|null
    {
        return $this->data['valid'] ?? null;
    }

}
