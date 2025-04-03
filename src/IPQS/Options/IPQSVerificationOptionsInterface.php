<?php

declare(strict_types=1);

namespace IPQS\Options;

interface IPQSVerificationOptionsInterface extends \Stringable
{
    public function toArray(): array;
}
