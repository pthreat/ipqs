<?php

declare(strict_types=1);

namespace IPQS\Service\Phone\Options;

readonly class PhoneVerificationOptions implements PhoneVerificationOptionsInterface
{
    public function __construct(
        private array $countries = [],
        private int $strictness = 0
    ) {
    }

    public function getCountries(): array
    {
        return $this->countries;
    }

    public function getStrictness(): int
    {
        return $this->strictness;
    }

    public function toArray(): array
    {
        return [
            'country' => $this->countries,
            'strictness' => $this->strictness
        ];
    }

    public function __toString(): string
    {
        return http_build_query($this->toArray());
    }
}
