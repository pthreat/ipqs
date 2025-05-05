<?php

declare(strict_types=1);

namespace IPQS\Service\Device\Options;

use IPQS\Options\IPQSVerificationOptionsInterface;

interface DeviceVerificationOptionsInterface extends IPQSVerificationOptionsInterface
{
    public function getFingerprint(): string;

}
