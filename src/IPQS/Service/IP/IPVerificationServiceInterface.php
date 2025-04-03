<?php

declare(strict_types=1);

namespace IPQS\Service\IP;

use IPQS\Options\IPQSVerificationOptionsInterface;
use IPQS\Service\IP\Response\IPVerificationResponseInterface;
use IPQS\Service\IPQSVerificationServiceInterface;

interface IPVerificationServiceInterface extends IPQSVerificationServiceInterface
{
    /**
     * @throws Exception\IPVerificationServiceException
     */
    public function verify(
        \Stringable|string $value,
        IPQSVerificationOptionsInterface $options
    ): IPVerificationResponseInterface;
}
