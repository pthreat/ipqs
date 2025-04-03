<?php

declare(strict_types=1);

namespace IPQS\Service\Phone\Response;

use IPQS\Response\IPQSVerificationResponseInterface;

interface PhoneVerificationResponseInterface extends IPQSVerificationResponseInterface
{
    /**
     * This value will indicate if there has been any recently verified abuse across our network for this phone number.
     * Abuse could be a confirmed chargeback, fake signup, compromised device, fake app install, or similar malicious
     * behavior within the past few days.
     */
    public function isRecentAbuse(): bool|null;

    /**
     * This value will indicate the formatted value for this phone number.
     * This will be a concatenation of +, the country code and the phone number.
     */
    public function getFormatted(): string|null;

    /**
     * This value will indicate the local formatted value for this phone number.
     * This will have parenthesis and spaces and does not include the country code.
     */
    public function getLocalFormat(): string|null;

    /**
     * This value will indicate if the phone number is voice over IP.
     */
    public function isVoip(): bool|null;

    /**
     * This value will indicate if the phone number is prepaid.
     */
    public function isPrepaid(): bool|null;

    /**
     * This value will indicate if the phone number is risky.
     */
    public function isRisky(): bool|null;

    /**
     * This value will indicate if the phone number is active.
     */
    public function isActive(): bool|null;

    /**
     * Name of the phone holder.
     */
    public function getName(): string|null;

    /**
     * Carrier of the phone plan.
     */
    public function getCarrier(): string|null;

    /**
     * Line type of the phone.
     */
    public function getLineType(): string|null;

    /**
     * Country of the phone.
     */
    public function getCountry(): string|null;

    /**
     * Region of the phone.
     */
    public function getRegion(): string|null;

    /**
     * Associated email addresses of the phone.
     */
    public function getAssociatedEmailAddresses(): array|null;

    /**
     * Was this phone number associated with a recent database leak from a third party?
     * Leaked accounts pose a risk as they may have become compromised during a database breach.
     */
    public function isLeaked(): bool|null;

    /**
     * Does this phone number appear valid?
     */
    public function isValid(): bool|null;

    /**
     * A unique identifier for this request that can be used to look up the request details or send a postback
     * conversion notice.
     */
    public function getRequestId(): string|null;
}
