<?php

declare(strict_types=1);

namespace IPQS\Response;

interface IPQSVerificationResponseInterface
{
    /**
     * Factory method to craft an IPQSVerificationResponseInterface from a JSON body.
     *
     * @throws \JsonException
     */
    public static function fromJSON(string $body): IPQSVerificationResponseInterface;

    /**
     * A generic status message, either success or some form of an error notice.
     */
    public function getMessage(): string|null;

    /**
     * Was the request successful?
     */
    public function isSuccess(): bool|null;

    /**
     * A unique identifier for this request that can be used to look up
     * the request details or send a postback conversion notice.
     */
    public function getRequestId(): string|null;

    /**
     * @throws \JsonException
     * Returns response in JSON format
     */
    public function toJSON(int $flags) : string;

    /**
     * Returns raw response body.
     */
    public function toArray(): array;
}
