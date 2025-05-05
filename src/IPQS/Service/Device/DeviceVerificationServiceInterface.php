<?php

declare(strict_types=1);

namespace IPQS\Service\Device;

use IPQS\Options\IPQSVerificationOptionsInterface;
use IPQS\Service\Device\Response\DeviceVerificationResponseInterface;
use IPQS\Service\IPQSVerificationServiceInterface;

interface DeviceVerificationServiceInterface extends IPQSVerificationServiceInterface
{
    /**
     * @throws Exception\DeviceVerificationServiceException
     */
    public function verify(
        \Stringable|string $value,
        IPQSVerificationOptionsInterface $options
    ): DeviceVerificationResponseInterface;
}
