<?php

declare(strict_types=1);

namespace IPQS\Service\Email\Options;

readonly class EmailVerificationOptions implements EmailVerificationOptionsInterface
{
    public function __construct(
        private bool $fastResponse = false,
        private int $replyTimeout = 7,
        private int $abuseStrictness = 0,
    ) {
    }

    public function isFastResponse(): bool
    {
        return $this->fastResponse;
    }

    public function getReplyTimeout(): int
    {
        return $this->replyTimeout;
    }

    public function getAbuseStrictness(): int
    {
        return $this->abuseStrictness;
    }

    public function toArray(): array
    {
        return [
            'timeout' => $this->replyTimeout,
            'fast' => $this->fastResponse,
            'abuse_strictness' => $this->abuseStrictness
        ];
    }

    public function __toString(): string
    {
        return http_build_query($this->toArray());
    }
}
