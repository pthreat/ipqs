<?php

declare(strict_types=1);

namespace IPQS\Service\IP;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Uri;
use IPQS\IPQSConstants;
use IPQS\Options\IPQSVerificationOptionsInterface;
use IPQS\Service\IP\Options\IPVerificationOptionsInterface;
use IPQS\Service\IP\Response\IPVerificationResponse;
use IPQS\Service\IP\Response\IPVerificationResponseInterface;

readonly class IPVerificationService implements IPVerificationServiceInterface
{
    private const string API_ENDPOINT = 'json/ip/:key/:ip?:query';

    public function __construct(
        private ClientInterface $client,
        private string $key
    ) {
    }

    public function verify(
        string|\Stringable $value,
        IPQSVerificationOptionsInterface $options
    ): IPVerificationResponseInterface {
        if (!$options instanceof IPVerificationOptionsInterface) {
            $msg = sprintf('Given options is not an instance of: %s', IPVerificationOptionsInterface::class);
            throw new \InvalidArgumentException($msg);
        }

        $path = strtr(self::API_ENDPOINT, [
            ':key' => $this->key,
            ':ip' => (string) $value,
            ':query' => (string) $options
        ]);

        $uri = new Uri(sprintf('%s/%s', IPQSConstants::API_URL, $path));

        try {
            $response = $this->client->request('GET', $uri, [
                'headers' => [
                    'User-Agent' => sprintf('pthreat/IPQS Version: %s', IPQSConstants::VERSION)
                ]
            ]);

            return IPVerificationResponse::fromJSON($response->getBody()->getContents());
        } catch (GuzzleException|\JsonException $e) {
            $msg = 'Failed to perform IP address verification';
            throw new Exception\IPVerificationServiceException($msg, 0, $e);
        }
    }
}
