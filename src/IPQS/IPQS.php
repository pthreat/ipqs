<?php

declare(strict_types=1);

namespace IPQS;

use GuzzleHttp\ClientInterface;
use IPQS\Service\Email\EmailVerificationService;
use IPQS\Service\Email\EmailVerificationServiceInterface;
use IPQS\Service\IP\IPVerificationService;
use IPQS\Service\IP\IPVerificationServiceInterface;
use IPQS\Service\Phone\PhoneVerificationService;
use IPQS\Service\Phone\PhoneVerificationServiceInterface;

readonly class IPQS implements IPQSInterface
{
    public function __construct(
        private ClientInterface $client,
        private string $key
    ) {
    }

    public function email(): EmailVerificationServiceInterface
    {
        return new EmailVerificationService($this->client, $this->key);
    }

    public function phone(): PhoneVerificationServiceInterface
    {
        return new PhoneVerificationService($this->client, $this->key);
    }

    public function ip(): IPVerificationServiceInterface
    {
        return new IPVerificationService($this->client, $this->key);
    }
}
