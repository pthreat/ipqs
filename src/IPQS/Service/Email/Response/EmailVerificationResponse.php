<?php

declare(strict_types=1);

namespace IPQS\Service\Email\Response;

readonly class EmailVerificationResponse implements EmailVerificationResponseInterface
{
    public function __construct(private array $data)
    {
    }

    public static function fromJSON(string $body): EmailVerificationResponseInterface
    {
        return new self(
            json_decode($body, true, 512, \JSON_THROW_ON_ERROR)
        );
    }

    public function isTimedOut(): bool|null
    {
        return $this->data['timed_out'] ?? null;
    }

    public function isDisposable(): bool|null
    {
        return $this->data['disposable'] ?? null;
    }

    public function getFirstName(): string|null
    {
        return $this->data['first_name'] ?? null;
    }

    public function getDeliverability(): string|null
    {
        return $this->data['deliverability'] ?? null;
    }

    public function getSmtpScore(): int|null
    {
        return $this->data['smtp_score'] ?? null;
    }

    public function getOverallScore(): ?int
    {
        return $this->data['overall_score'] ?? null;
    }

    public function isCatchAll(): bool|null
    {
        return $this->data['catch_all'] ?? null;
    }

    public function isGeneric(): bool|null
    {
        return $this->data['generic'] ?? null;
    }

    public function isCommon(): bool|null
    {
        return $this->data['common'] ?? null;
    }

    public function isDnsValid(): bool|null
    {
        return $this->data['dns_valid'] ?? null;
    }

    public function isHoneypot(): bool|null
    {
        return $this->data['honeypot'] ?? null;
    }

    public function isFrequentComplainer(): bool|null
    {
        return $this->data['frequent_complainer'] ?? null;
    }

    public function isSuspect(): bool|null
    {
        return $this->data['suspect'] ?? null;
    }

    public function isRecentAbuse(): bool|null
    {
        return $this->data['recent_abuse'] ?? null;
    }

    public function isLeaked(): bool|null
    {
        return $this->data['leaked'] ?? null;
    }

    public function getSuggestedDomain(): string|null
    {
        return $this->data['suggested_domain'] ?? null;
    }

    public function isValid(): bool|null
    {
        return $this->data['valid'] ?? null;
    }

    public function isSuccess(): bool|null
    {
        return $this->data['success'] ?? null;
    }

    public function isSpamTrapScore(): bool|null
    {
        return $this->data['spam_trap_score'] ?? null;
    }

    public function getRequestId(): string|null
    {
        return $this->data['request_id'] ?? null;
    }

    public function getDomainAge(): array|null
    {
        return $this->data['domain_age'] ?? null;
    }

    public function getFirstSeen(): array|null
    {
        return $this->data['first_seen'] ?? null;
    }

    public function getMessage(): string|null
    {
        return $this->data['message'] ?? null;
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
