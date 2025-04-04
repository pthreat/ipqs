<?php

declare(strict_types=1);

namespace IPQS\Service\Phone\Response;

readonly class PhoneVerificationResponse implements PhoneVerificationResponseInterface
{
    public function __construct(private array $data)
    {
    }

    public static function fromJSON(string $body): PhoneVerificationResponseInterface
    {
        return new self(
            json_decode($body, true, 512, \JSON_THROW_ON_ERROR)
        );
    }

    public function isRecentAbuse(): bool|null
    {
        return $this->data['recent_abuse'] ?? null;
    }

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

    public function isSuccess(): bool|null
    {
        return $this->data['success'] ?? null;
    }

    public function getRequestId(): string|null
    {
        return $this->data['request_id'] ?? null;
    }

    public function getMessage(): string|null
    {
        return $this->data['message'] ?? null;
    }

    public function toArray(): array
    {
        return $this->data;
    }

    public function toJSON(int $flags=\JSON_THROW_ON_ERROR|\JSON_PRETTY_PRINT): string
    {
        return json_encode($this->data, $flags);
    }

}
