<?php

declare(strict_types=1);

namespace IPQS\Service;

use IPQS\Options\IPQSVerificationOptionsInterface;
use IPQS\Response\IPQSVerificationResponseInterface;

interface IPQSVerificationServiceInterface
{
    public function verify(
        string|\Stringable $value,
        IPQSVerificationOptionsInterface $options
    ): IPQSVerificationResponseInterface;
}
