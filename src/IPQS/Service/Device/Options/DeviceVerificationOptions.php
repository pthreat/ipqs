<?php

declare(strict_types=1);

namespace IPQS\Service\Device\Options;

readonly class DeviceVerificationOptions implements DeviceVerificationOptionsInterface
{
    public function __construct(
        private string $fingerprint,
    ) {
    }

    public function getFingerprint(): string
    {
        return $this->fingerprint;
    }

    public function toArray(): array
    {
        return [
            'fingerprint' => $this->fingerprint
        ];
    }

    public function __toString(): string
    {
        return http_build_query($this->toArray());
    }
}
