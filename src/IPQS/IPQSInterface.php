<?php

declare(strict_types=1);

namespace IPQS;

use IPQS\Service\Device\DeviceVerificationServiceInterface;
use IPQS\Service\Email\EmailVerificationServiceInterface;
use IPQS\Service\IP\IPVerificationServiceInterface;
use IPQS\Service\Phone\PhoneVerificationServiceInterface;
use IPQS\Service\Request\IPQSRequestServiceInterface;

interface IPQSInterface
{
    public function email(): EmailVerificationServiceInterface;

    public function phone(): PhoneVerificationServiceInterface;

    public function ip(): IPVerificationServiceInterface;

    public function device(): DeviceVerificationServiceInterface;

    public function request() : IPQSRequestServiceInterface;

}
