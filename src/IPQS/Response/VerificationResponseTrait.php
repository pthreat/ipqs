<?php

declare(strict_types=1);

namespace IPQS\Response;

use IPQS\Service\Phone\Response\PhoneVerificationResponseInterface;

trait VerificationResponseTrait
{

    public function __construct(private readonly array $data)
    {
    }

    public function getFraudScore() : float|null
    {
        return $this->data['fraud_score'] ?? null;
    }

    public function getMessage(): string|null
    {
        return $this->data['message'] ?? null;
    }

    public function isSuccess(): bool|null
    {
        return $this->data['success'] ?? null;
    }

    public function getRequestId(): string|null
    {
        return $this->data['request_id'] ?? null;
    }

    public function isRecentAbuse(): bool|null
    {
        return $this->data['recent_abuse'] ?? null;
    }

    public static function fromJSON(string $body): IPQSVerificationResponseInterface
    {
        return new self(
            json_decode($body, true, 512, \JSON_THROW_ON_ERROR)
        );
    }

    public function toArray(): array
    {
        return $this->data;
    }

    public function toJSON(int $flags=\JSON_THROW_ON_ERROR|\JSON_PRETTY_PRINT): string
    {
        return json_encode($this->data, $flags);
    }

}