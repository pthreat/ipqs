<?php

declare(strict_types=1);

namespace IPQS;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Client as HTTPClient;
use IPQS\Service\Device\DeviceVerificationService;
use IPQS\Service\Device\DeviceVerificationServiceInterface;
use IPQS\Service\Email\EmailVerificationService;
use IPQS\Service\Email\EmailVerificationServiceInterface;
use IPQS\Service\IP\IPVerificationService;
use IPQS\Service\IP\IPVerificationServiceInterface;
use IPQS\Service\Phone\PhoneVerificationService;
use IPQS\Service\Phone\PhoneVerificationServiceInterface;

readonly class IPQS implements IPQSInterface
{
    public function __construct(
        private string $key,
        private ClientInterface|null $client=null
    ) {
    }

    public function email(): EmailVerificationServiceInterface
    {
        return new EmailVerificationService($this->client ?? new HTTPClient(), $this->key);
    }

    public function phone(): PhoneVerificationServiceInterface
    {
        return new PhoneVerificationService($this->client ?? new HTTPClient(), $this->key);
    }

    public function ip(): IPVerificationServiceInterface
    {
        return new IPVerificationService($this->client ?? new HTTPClient(), $this->key);
    }

    public function device(): DeviceVerificationServiceInterface
    {
        return new DeviceVerificationService($this->client ?? new HTTPClient(), $this->key);
    }
}
