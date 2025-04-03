<?php

declare(strict_types=1);

namespace IPQS\Service\Email\Options;

use IPQS\Options\IPQSVerificationOptionsInterface;

interface EmailVerificationOptionsInterface extends IPQSVerificationOptionsInterface
{
    public function isFastResponse(): bool;

    public function getReplyTimeout(): int;

    public function getAbuseStrictness(): int;
}
