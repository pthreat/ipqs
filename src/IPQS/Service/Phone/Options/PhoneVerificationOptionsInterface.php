<?php

declare(strict_types=1);

namespace IPQS\Service\Phone\Options;

use IPQS\Options\IPQSVerificationOptionsInterface;

interface PhoneVerificationOptionsInterface extends IPQSVerificationOptionsInterface
{
    public function getCountries(): array;

    public function getStrictness(): int;
}
