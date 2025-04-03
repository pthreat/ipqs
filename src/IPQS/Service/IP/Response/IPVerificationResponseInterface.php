<?php

declare(strict_types=1);

namespace IPQS\Service\IP\Response;

use IPQS\Response\IPQSVerificationResponseInterface;

interface IPVerificationResponseInterface extends IPQSVerificationResponseInterface
{
    /**
     * Is this IP address suspected to be a proxy? (SOCKS, Elite, Anonymous, VPN, Tor, etc.).
     */
    public function isProxy(): bool|null;

    /**
     * Hostname of the IP address if one is available.
     */
    public function getHost(): string|null;

    /**
     * ISP if one is known. Otherwise, "N/A".
     */
    public function getIsp(): string|null;

    /**
     * Organization if one is known. Can be parent company or sub company of the listed ISP. Otherwise "N/A".
     */
    public function getOrganization(): string|null;

    /**
     * Autonomous System Number if one is known. Otherwise, "N/A".
     */
    public function getAsn(): string|null;

    /**
     * Two character country code of IP address or "N/A" if unknown.
     */
    public function getCountryCode(): string|null;

    /**
     * City of IP address if available or "N/A" if unknown.
     */
    public function getCity(): string|null;

    /**
     * Region (state) of IP address if available or "N/A" if unknown.
     */
    public function getRegion(): string|null;

    /**
     * Timezone of IP address if available or "N/A" if unknown.
     */
    public function getTimezone(): string|null;

    /**
     * Latitude of IP address if available or "N/A" if unknown.
     */
    public function getLatitude(): string|null;

    /**
     * Longitude of IP address if available or "N/A" if unknown.
     */
    public function getLongitude(): string|null;

    /**
     * Is this IP associated with being a confirmed crawler from a mainstream search engine such as Googlebot,
     * Bing bot, Yandex, etc. based on hostname or IP address verification.
     */
    public function isCrawler(): bool|null;

    /**
     * Classification of the IP address connection type as:
     * "Residential", "Corporate", "Education", "Mobile", or "Data Center".
     */
    public function getConnectionType(): string|null;

    /**
     * This value will indicate if there has been any recently verified abuse across our network for this IP address.
     * Abuse could be a confirmed chargeback, compromised device, fake app install, or similar malicious behavior within the past few days.
     */
    public function isRecentAbuse(): bool|null;

    /**
     * Indicates if bots or non-human traffic has recently used this IP address to engage in automated fraudulent behavior.
     * Provides stronger confidence that the IP address is suspicious.
     */
    public function isBotStatus(): bool|null;

    /**
     * Is this IP suspected of being a VPN connection?
     * (proxy will always be true if this is true).
     */
    public function isVpn(): bool|null;

    /**
     * Is this IP suspected of being a Tor connection?
     * (proxy will always be true if this is true).
     */
    public function isTor(): bool|null;

    /**
     * Is this user agent a mobile browser?
     * (will always be false if the user agent is not passed in the API request).
     */
    public function isMobile(): bool|null;

    /**
     * The overall fraud score of the user based on the IP, user agent, language, and any other optionally
     * passed variables. Fraud Scores >= 75 are suspicious, but not necessarily fraudulent.
     * We recommend flagging or blocking traffic with Fraud Scores >= 85, but you may find
     * it beneficial to use a higher or lower threshold.
     */
    public function getFraudScore(): float|null;

    /**
     * Operating system name and version or "N/A" if unknown.
     * Requires the "user_agent" variable in the API Request.
     */
    public function getOperatingSystem(): string|null;

    /**
     * Browser name and version or "N/A" if unknown.
     * Requires the "user_agent" variable in the API Request.
     */
    public function getBrowser(): string|null;

    /**
     * Brand name of the device or "N/A" if unknown.
     * Requires the "user_agent" variable in the API Request.
     */
    public function getDeviceBrand(): string|null;

    /**
     * Model name of the device or "N/A" if unknown.
     * Requires the "user_agent" variable in the API Request.
     */
    public function getDeviceModel(): string|null;

    /**
     * A unique identifier for this request that can be used to look up
     * the request details or send a postback conversion notice.
     */
    public function getRequestId(): string|null;
}
