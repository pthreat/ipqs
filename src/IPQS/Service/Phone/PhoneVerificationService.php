<?php

declare(strict_types=1);

namespace IPQS\Service\Phone;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Uri;
use IPQS\IPQSConstants;
use IPQS\Options\IPQSVerificationOptionsInterface;
use IPQS\Service\Phone\Options\PhoneVerificationOptionsInterface;
use IPQS\Service\Phone\Response\PhoneVerificationResponse;
use IPQS\Service\Phone\Response\PhoneVerificationResponseInterface;

readonly class PhoneVerificationService implements PhoneVerificationServiceInterface
{
    private const string API_ENDPOINT = 'json/phone/:key/:phone?:query';

    public function __construct(
        private ClientInterface $client,
        private string $key
    ) {
    }

    public function verify(
        string|\Stringable $value,
        IPQSVerificationOptionsInterface $options
    ): PhoneVerificationResponseInterface {
        if (!$options instanceof PhoneVerificationOptionsInterface) {
            $msg = sprintf('Given options is not an instance of: %s', PhoneVerificationOptionsInterface::class);
            throw new \InvalidArgumentException($msg);
        }

        $path = strtr(self::API_ENDPOINT, [
            ':key' => $this->key,
            ':phone' => (string) $value,
            ':query' => (string) $options
        ]);

        $uri = new Uri(sprintf('%s/%s', IPQSConstants::API_URL, $path));

        try {
            $response = $this->client->request('GET', $uri, [
                'headers' => [
                    'User-Agent' => sprintf('pthreat/IPQS Version: %s', IPQSConstants::VERSION)
                ]
            ]);

            return PhoneVerificationResponse::fromJSON($response->getBody()->getContents());
        } catch (GuzzleException|\JsonException $e) {
            $msg = 'Failed to perform email verification';
            throw new Exception\PhoneVerificationServiceException($msg, 0, $e);
        }
    }
}
