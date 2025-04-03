<?php

declare(strict_types=1);

namespace IPQS\Service\Email\Response;

use IPQS\Response\IPQSVerificationResponseInterface;

interface EmailVerificationResponseInterface extends IPQSVerificationResponseInterface
{
    /**
     * Did the connection to the mail service provider timeout during the verification?
     * If so, we recommend increasing the "timeout" variable above the default 7 second value.
     * Lookups that timeout with a "valid" result as false are most likely false and should be not be trusted.
     */
    public function isTimedOut(): bool|null;

    /**
     * Is this email suspected of belonging to a temporary or disposable mail service?
     * Usually associated with fraudsters and scammers.
     */
    public function isDisposable(): bool|null;

    /**
     * Suspected first name based on email. Returns "CORPORATE" if the email is suspected of being a generic company email.
     * Returns "UNKNOWN" if the first name was not determinable.
     */
    public function getFirstName(): string|null;

    /**
     * How likely is this email to be delivered to the user and land in their mailbox.
     * Values can be "high", "medium", or "low".
     */
    public function getDeliverability(): string|null;

    /**
     * Validity score of email server's SMTP setup. Range: "-1" - "3". Scores above "-1" can be associated with a valid email.
     * -1 = invalid email address
     * 0 = mail server exists, but is rejecting all mail
     * 1 = mail server exists, but is showing a temporary error
     * 2 = mail server exists, but accepts all email
     * 3 = mail server exists and has verified the email address.
     */
    public function getSmtpScore(): int|null;

    /**
     * Overall email validity score. Range: "0" - "4". Scores above "1" can be associated with a valid email.
     * 0 = invalid email address
     * 1 = dns valid, unreachable mail server
     * 2 = dns valid, temporary mail rejection error
     * 3 = dns valid, accepts all mail
     * 4 = dns valid, verified email exists.
     */
    public function getOverallScore(): int|null;

    /**
     * Is this email likely to be a "catch all" where the mail server verifies all emails tested against it as valid?
     * It is difficult to determine if the address is truly valid in these scenarios, since the email's server will not confirm the account's status.
     */
    public function isCatchAll(): bool|null;

    /**
     * Is this email suspected as being a catch all or shared email for a domain?
     * ("admin@", "webmaster@", "newsletter@", "sales@", "contact@", etc.).
     */
    public function isGeneric(): bool|null;

    /**
     * Is this email from a common email provider? ("gmail.com", "yahoo.com", "hotmail.com", etc.).
     */
    public function isCommon(): bool|null;

    /**
     * Does the email's hostname have valid DNS entries? Partial indication of a valid email.
     */
    public function isDnsValid(): bool|null;

    /**
     * Is this email believed to be a "honeypot" or "SPAM trap"?
     * Bulk mail sent to these emails increases your risk of being blacklisted by large ISPs & ending up in the spam folder.
     */
    public function isHoneypot(): bool|null;

    /**
     * Indicates if this email frequently unsubscribes from marketing lists or reports email as SPAM.
     */
    public function isFrequentComplainer(): bool|null;

    /**
     * This value indicates if the mail server is currently replying with a temporary error and unable to verify the email address.
     * This status will also be true for "catch all" email addresses as defined below.
     * If this value is true, then we suspect the "valid" result may be tainted and there is not a guarantee that the email address is truly valid.
     */
    public function isSuspect(): bool|null;

    /**
     * This value will indicate if there has been any recently verified abuse across our network for this email address.
     * Abuse could be a confirmed chargeback, fake signup, compromised device, fake app install, or similar malicious behavior within the past few days.
     */
    public function isRecentAbuse(): bool|null;

    /**
     * Was this email address associated with a recent database leak from a third party?
     * Leaked accounts pose a risk as they may have become compromised during a database breach.
     */
    public function isLeaked(): bool|null;

    /**
     * Default value is "N/A". Indicates if this email's domain should in fact be corrected to a popular mail service.
     * This field is useful for catching user typos. For example, an email address with "gmai.com", would display a suggested domain of "gmail.com".
     * This feature supports all major mail service providers.
     */
    public function getSuggestedDomain(): string|null;

    /**
     * Does this email address appear valid?
     */
    public function isValid(): bool|null;

    /**
     * Was the request successful?
     */
    public function isSuccess(): bool|null;

    /**
     * Confidence level of the email address being an active SPAM trap. Values can be "high", "medium", "low", or "none".
     * We recommend scrubbing emails with "high" or "medium" statuses. Avoid "low" emails whenever possible for any promotional mailings.
     */
    public function isSpamTrapScore(): bool|null;

    /**
     * A unique identifier for this request that can be used to lookup the request details or send a postback conversion notice.
     */
    public function getRequestId(): string|null;

    /**
     * human	    A human description of when this domain was registered. (Ex: 3 months ago)	            string or null
     * timestamp	The unix time since epoch when this domain was first registered. (Ex: 1568061634)	    integer
     * iso	        The time this domain was registered in ISO8601 format (Ex: 2019-09-09T16:40:34-04:00)	string.
     */
    public function getDomainAge(): array|null;

    /**
     * human    	A human description of how long it's been since IPQS first analyzed this email address. (Ex: 3 months ago)	string or null
     * timestamp	The unix time since epoch when this email was first analyzed by IPQS. (Ex: 1568061634)	                    integer
     * iso	        The time this email was first analyzed by IPQS in ISO8601 format (Ex: 2019-09-09T16:40:34-04:00)	        string.
     */
    public function getFirstSeen(): array|null;

    /**
     * A generic status message, either success or some form of an error notice.
     */
    public function getMessage(): string|null;
}
