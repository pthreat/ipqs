<?php

declare(strict_types=1);

namespace IPQS\Service\Device\Response;

use IPQS\Response\IPQSVerificationResponseInterface;

interface DeviceVerificationResponseInterface extends IPQSVerificationResponseInterface
{
    public function getFingerprint() : string|null;
    public function isUnique() : bool|null;
    public function getIp() : string|null;
}
