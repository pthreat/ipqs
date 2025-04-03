<?php

declare(strict_types=1);

namespace IPQS;

use IPQS\Service\Email\EmailVerificationServiceInterface;
use IPQS\Service\IP\IPVerificationServiceInterface;
use IPQS\Service\Phone\PhoneVerificationServiceInterface;

interface IPQSInterface
{
    public function email(): EmailVerificationServiceInterface;

    public function phone(): PhoneVerificationServiceInterface;

    public function ip(): IPVerificationServiceInterface;
}
