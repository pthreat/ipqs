<?php

declare(strict_types=1);

namespace IPQS\Service\Phone;

use IPQS\Options\IPQSVerificationOptionsInterface;
use IPQS\Service\IPQSVerificationServiceInterface;

interface PhoneVerificationServiceInterface extends IPQSVerificationServiceInterface
{
    /**
     * @throws Exception\PhoneVerificationServiceException
     */
    public function verify(
        \Stringable|string $value,
        IPQSVerificationOptionsInterface $options
    ): Response\PhoneVerificationResponseInterface;
}
