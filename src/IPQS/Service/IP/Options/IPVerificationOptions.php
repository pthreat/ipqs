<?php

declare(strict_types=1);

namespace IPQS\Service\IP\Options;

readonly class IPVerificationOptions implements IPVerificationOptionsInterface
{
    public function __construct(
        private int $strictness,
        private bool $allowPublicAccessPoints,
        private bool $mobile,
        private bool $lighterPenalties,
        private string $userAgent = '',
        private string $userLanguage = '',
    ) {
    }

    public function getStrictness(): int
    {
        return $this->strictness;
    }

    public function getUserAgent(): string
    {
        return $this->userAgent;
    }

    public function getUserLanguage(): string
    {
        return $this->userLanguage;
    }

    public function isAllowPublicAccessPoints(): bool
    {
        return $this->allowPublicAccessPoints;
    }

    public function isMobile(): bool
    {
        return $this->mobile;
    }

    public function isLighterPenalties(): bool
    {
        return $this->lighterPenalties;
    }

    public function toArray(): array
    {
        return [
            'user_agent' => $this->userAgent,
            'user_language' => $this->userLanguage,
            'strictness' => $this->strictness,
            'allow_public_access_points' => true === $this->allowPublicAccessPoints ? 'true' : 'false',
            'mobile' => true === $this->mobile ? 'true' : 'false',
            'lighter_penalties' => true === $this->lighterPenalties ? 'true' : 'false'
        ];
    }

    public function __toString(): string
    {
        return http_build_query($this->toArray());
    }
}
