<?php

declare(strict_types=1);

namespace IPQS\Service\IP\Response;

use IPQS\Response\VerificationResponseTrait;

readonly class IPVerificationResponse implements IPVerificationResponseInterface
{
    use VerificationResponseTrait;

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

    public function getRequestId(): string|null
    {
        return $this->data['request_id'] ?? null;
    }

}
