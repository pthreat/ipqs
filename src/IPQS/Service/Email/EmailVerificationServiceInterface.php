<?php

declare(strict_types=1);

namespace IPQS\Service\Email;

use IPQS\Options\IPQSVerificationOptionsInterface;
use IPQS\Service\Email\Response\EmailVerificationResponseInterface;
use IPQS\Service\IPQSVerificationServiceInterface;

interface EmailVerificationServiceInterface extends IPQSVerificationServiceInterface
{
    public function verify(
        \Stringable|string $value,
        IPQSVerificationOptionsInterface $options
    ): EmailVerificationResponseInterface;
}
