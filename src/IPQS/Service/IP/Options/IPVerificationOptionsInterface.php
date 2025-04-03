<?php

declare(strict_types=1);

namespace IPQS\Service\IP\Options;

use IPQS\Options\IPQSVerificationOptionsInterface;

interface IPVerificationOptionsInterface extends IPQSVerificationOptionsInterface
{
    public function getStrictness(): int;

    public function getUserAgent(): string;

    public function getUserLanguage(): string;

    public function isAllowPublicAccessPoints(): bool;

    public function isMobile(): bool;

    public function isLighterPenalties(): bool;
}
