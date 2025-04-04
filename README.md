# Pthreat IPQS

IPQS (ip quality score) is an API service specialized on fraud metrics for emails, ip addresses and phone numbers.

NOTE: This package is partially based on Jamaloo's IPQS package, this version adds PHP 8.3 support + Guzzle HTTP adapter

## Installation

- [Download composer](https://getcomposer.org)
- Run `composer require pthreat/ipqs`
- Get API key https://www.ipqualityscore.com/create-account for 5,000 FREE api calls per month

## Docker

This package can be run straight with docker compose

```text

git clone git@github.com:pthreat/ipqs.git
cd ipqs

# Replace xxxx with your actual IPQS key, see installation above to get a free API key
echo 'IPQS_KEY=xxxxxxxxxxxxxxxxxx' > environment

sudo docker compose up ipqs -d 
./bin/de ipqs 
ipqs --help
```

## Instantiation

The main client lives under IPQS\IPQS, even tho, this is just a convenient class which holsters all other classes
It's only purpose is to work as a "factory" for IPQS verification services (Email, Phone and IP).

You can instantiate any of the validators separately if you wish, the constructor signature is the same for all of them.

```php
    public function __construct(
        private \GuzzleHttp\ClientInterface $client,
        private string $key
    ) {
```

As you can see, this library allows you to use a custom Guzzle client, so you can have more flexibility when using it,
i.e: adding custom headers, etc.

# Usable code examples

These examples use the IPQS\IPQS factory, as stated previously you can use this class or instantiate services separately

Email verification IPQS Docs: https://www.ipqualityscore.com/documentation/email-validation-api/overview

### Email Verification

```php
    use GuzzleHttp\Client;
    use IPQS\Service\Email\Options\EmailVerificationOptions;
    
    $ipqs = new IPQS\IPQS(key: 'MY-IPQS-API-KEY');
    
    $result = $ipqs->email()->verify(
        value: 'some@email.com',
        options: new EmailVerificationOptions(
            fastResponse: true,
            replyTimeout: 7,
            abuseStrictness: 0
        )
    );

    /**
     * @see src/IPQS/Service/Email/Response/EmailVerificationResponseInterface.php
     * For a comprehensive list of all available methods.
     */           
    var_dump($result->getDeliverability());
    var_dump($result->getFirstName());
    var_dump($result->isDisposable());
```

#### Raw email verification response:

```text
^ array:35 
  "message" => "Success."
  "success" => true
  "valid" => true
  "disposable" => false
  "smtp_score" => 3
  "overall_score" => 4
  "first_name" => "JOHN DOE"
  "generic" => false
  "common" => true
  "dns_valid" => true
  "honeypot" => false
  "deliverability" => "high"
  "frequent_complainer" => false
  "spam_trap_score" => "none"
  "catch_all" => false
  "timed_out" => false
  "suspect" => false
  "recent_abuse" => false
  "fraud_score" => 0
  "suggested_domain" => "N/A"
  "leaked" => true
  "domain_age" => array:3 [
    "human" => "30 years ago"
    "timestamp" => 808286400
    "iso" => "1995-08-13T00:00:00-04:00"
  ]
  "first_seen" => array:3 [
    "human" => "8 years ago"
    "timestamp" => 1483250461
    "iso" => "2017-01-01T01:01:01-05:00"
  ]
  "domain_trust" => "trusted"
  "sanitized_email" => "john@doe.com"
  "domain_velocity" => "high"
  "user_activity" => "Disabled for performance. Contact support for further assistance."
  "associated_names" => array:2 [
    "status" => "Associated names found."
    "names" => array:1 [
      0 => "JOHN DOE"
    ]
  ]
  "associated_phone_numbers" => array:2 [
    "status" => "No associated phone numbers found."
    "phone_numbers" => []
  ]
  "risky_tld" => false
  "spf_record" => true
  "dmarc_record" => true
  "mx_records" => array:5 [
    0 => "alt4.gmail-smtp-in.l.google.com"
    1 => "alt1.gmail-smtp-in.l.google.com"
    2 => "gmail-smtp-in.l.google.com"
    3 => "alt2.gmail-smtp-in.l.google.com"
    4 => "alt3.gmail-smtp-in.l.google.com"
  ]
  "a_records" => array:8 [
    0 => "74.125.21.83"
    1 => "74.125.21.18"
    2 => "74.125.21.17"
    3 => "74.125.21.19"
    4 => "142.251.15.18"
    5 => "142.251.15.83"
    6 => "142.251.15.17"
    7 => "142.251.15.19"
  ]
  "request_id" => "xxxxxxxx"
]
```

### IP Verification

IPQS IP Verification documentation: https://www.ipqualityscore.com/documentation/proxy-detection-api/overview

```php
    use GuzzleHttp\Client;
    use IPQS\Service\IP\Options\IPVerificationOptions;
    
    $ipqs = new IPQS\IPQS(key: 'MY-IPQS-API-KEY');
    
    $result = $ipqs->ip()->verify(
        value: '127.0.0.1',
        options: new IPVerificationOptions(
            strictness: 0,
            allowPublicAccessPoints: true,
            mobile: false,
            lighterPenalties: false,
            userAgent: 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/134.0.0.0 Safari/537.36',
            userLanguage: 'en-US'
        )
    );

    /**
     * @see src/IPQS/Service/IP/Response/IPVerificationResponseInterface.php
     * For a comprehensive list of all available methods.
     */        
    var_dump($result->getFraudScore());
    var_dump($result->getIsp());
    var_dump($result->getCity());
    var_dump($result->getCountryCode());
```
#### Raw IP verification response:

```text
^ array:32 [
  "success" => true
  "message" => "Success"
  "fraud_score" => 0
  "country_code" => "AR"
  "region" => "Buenos Aires F.D."
  "city" => "Buenos Aires"
  "ISP" => "BT Latam Argentina SA"
  "ASN" => 7908
  "organization" => "Red Cooperativa de Comunicaciones"
  "is_crawler" => false
  "timezone" => "America/Argentina/Buenos_Aires"
  "mobile" => false
  "host" => "127-0-0-1.sencinet.com"
  "proxy" => false
  "vpn" => false
  "tor" => false
  "active_vpn" => false
  "active_tor" => false
  "recent_abuse" => false
  "bot_status" => false
  "connection_type" => "Residential"
  "abuse_velocity" => "none"
  "shared_connection" => true
  "dynamic_connection" => true
  "frequent_abuser" => false
  "high_risk_attacks" => false
  "security_scanner" => false
  "trusted_network" => false
  "zip_code" => "N/A"
  "latitude" => -34.58999445
  "longitude" => -58.37000107
  "request_id" => "xxxxxx"
]
```

### Phone Verification

Phone verification IPQS Docs: https://www.ipqualityscore.com/documentation/phone-number-validation-api/overview

```php
    use GuzzleHttp\Client;
    use IPQS\Service\Phone\Options\PhoneVerificationOptions;
    
    $ipqs = new IPQS\IPQS(key: 'MY-IPQS-API-KEY');

    $result = $ipqs->phone()->verify(
        value: '5491199999999',
        options: new PhoneVerificationOptions(
            countries: [],
            strictness: 0
        )
    );

    /**
     * @see src/IPQS/Service/Phone/Response/PhoneVerificationResponseInterface.php
     * For a comprehensive list of all available methods.
     */           
    var_dump($result->isVoip());
    var_dump($result->isPrepaid());
    var_dump($result->getLineType());
    var_dump($result->getCountry());
    var_dump($result->getCarrier());
```

#### Raw phone verification response:

```text
^ array:32 [
  "message" => "Phone is valid."
  "success" => true
  "formatted" => "+5491199999999"
  "local_format" => "011 15-59995-9999"
  "valid" => true
  "fraud_score" => 0
  "recent_abuse" => false
  "VOIP" => false
  "prepaid" => false
  "risky" => false
  "active" => true
  "carrier" => "Movistar"
  "line_type" => "Wireless"
  "country" => "AR"
  "city" => "Colonia Beron De Astrada"
  "zip_code" => "3197"
  "region" => "Buenos Aires"
  "dialing_code" => 54
  "active_status" => "Active Line"
  "sms_domain" => "sms.movistar.net.ar"
  "associated_email_addresses" => array:2 [
    "status" => "No associated emails found."
    "emails" => []
  ]
  "user_activity" => "Disabled for performance. Contact support for further assistance."
  "mnc" => "070"
  "mcc" => "722"
  "leaked" => false
  "spammer" => false
  "request_id" => "xxxxxx"
  "name" => "N/A"
  "timezone" => "America/Argentina/Buenos_Aires"
  "do_not_call" => false
  "accurate_country_code" => false
  "sms_email" => "0111599999999@sms.movistar.net.ar"
]
```