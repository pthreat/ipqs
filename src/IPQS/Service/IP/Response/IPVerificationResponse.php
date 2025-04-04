<?php

declare(strict_types=1);

namespace IPQS\Service\IP\Response;

readonly class IPVerificationResponse implements IPVerificationResponseInterface
{
    public function __construct(private array $data)
    {
    }

    public static function fromJSON(string $body): IPVerificationResponseInterface
    {
        return new self(
            json_decode($body, true, 512, \JSON_THROW_ON_ERROR)
        );
    }

    public function isProxy(): bool|null
    {
        return $this->data['proxy'] ?? null;
    }

    public function getHost(): string|null
    {
        return $this->data['host'] ?? null;
    }

    public function getIsp(): string|null
    {
        return $this->data['ISP'] ?? null;
    }

    public function getOrganization(): ?string
    {
        return $this->data['organization'] ?? null;
    }

    public function getAsn(): string|null
    {
        return $this->data['ASN'] ?? null;
    }

    public function getCountryCode(): string|null
    {
        return $this->data['country_code'] ?? null;
    }

    public function getCity(): string|null
    {
        return $this->data['city'] ?? null;
    }

    public function getRegion(): string|null
    {
        return $this->data['region'] ?? null;
    }

    public function getTimezone(): string|null
    {
        return $this->data['timezone'] ?? null;
    }

    public function getLatitude(): string|null
    {
        return $this->data['latitude'] ?? null;
    }

    public function getLongitude(): string|null
    {
        return $this->data['longitude'] ?? null;
    }

    public function isCrawler(): bool|null
    {
        return $this->data['is_crawler'] ?? null;
    }

    public function getConnectionType(): string|null
    {
        return $this->data['connection_type'] ?? null;
    }

    public function isRecentAbuse(): bool|null
    {
        return $this->data['recent_abuse'] ?? null;
    }

    public function isBotStatus(): bool|null
    {
        return $this->data['bot_status'] ?? null;
    }

    public function isVpn(): bool|null
    {
        return $this->data['vpn'] ?? null;
    }

    public function isTor(): bool|null
    {
        return $this->data['tor'] ?? null;
    }

    public function isMobile(): bool|null
    {
        return $this->data['mobile'] ?? null;
    }

    public function getFraudScore(): float|null
    {
        return $this->data['fraud_score'] ?? null;
    }

    public function getOperatingSystem(): string|null
    {
        return $this->data['operating_system'] ?? null;
    }

    public function getBrowser(): string|null
    {
        return $this->data['browser'] ?? null;
    }

    public function getDeviceBrand(): string|null
    {
        return $this->data['device_brand'] ?? null;
    }

    public function getDeviceModel(): string|null
    {
        return $this->data['device_model'] ?? null;
    }

    public function getMessage(): string|null
    {
        return $this->data['message'] ?? null;
    }

    public function isSuccess(): bool|null
    {
        return $this->data['success'] ?? null;
    }

    public function getRequestId(): string|null
    {
        return $this->data['request_id'] ?? null;
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
