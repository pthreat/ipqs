<?php

declare(strict_types=1);

namespace IPQS;

abstract class IPQSConstants
{
    public const string VERSION = '1.0.0';
    public const string API_URL = 'https://www.ipqualityscore.com/api';
    public const string USER_AGENT = 'pthreat/ipqs - Version '.self::VERSION;
}
