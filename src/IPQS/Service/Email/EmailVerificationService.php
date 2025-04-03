<?php

declare(strict_types=1);

namespace IPQS\Service\Email;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Uri;
use IPQS\IPQSConstants;
use IPQS\Options\IPQSVerificationOptionsInterface;
use IPQS\Service\Email\Exception\EmailVerificationServiceException;
use IPQS\Service\Email\Options\EmailVerificationOptionsInterface;
use IPQS\Service\Email\Response\EmailVerificationResponse;
use IPQS\Service\Email\Response\EmailVerificationResponseInterface;

readonly class EmailVerificationService implements EmailVerificationServiceInterface
{
    private const string API_ENDPOINT = 'json/email/:key/:email?:query';

    public function __construct(
        private ClientInterface $client,
        private string $key
    ) {
    }

    /**
     * @throws EmailVerificationServiceException
     */
    public function verify(
        string|\Stringable $value,
        IPQSVerificationOptionsInterface $options
    ): EmailVerificationResponseInterface {
        if (!$options instanceof EmailVerificationOptionsInterface) {
            $msg = sprintf('Given options is not an instance of: %s', EmailVerificationOptionsInterface::class);
            throw new \InvalidArgumentException($msg);
        }

        $path = strtr(self::API_ENDPOINT, [
            ':key' => $this->key,
            ':email' => (string) $value,
            ':query' => (string) $options
        ]);

        $uri = new Uri(sprintf('%s/%s', IPQSConstants::API_URL, $path));

        try {
            $response = $this->client->request('GET', $uri, [
                'headers' => [
                    'User-Agent' => sprintf('pthreat/IPQS Version: %s', IPQSConstants::VERSION)
                ]
            ]);

            return EmailVerificationResponse::fromJSON($response->getBody()->getContents());
        } catch (GuzzleException|\JsonException $e) {
            $msg = 'Failed to perform email verification';
            throw new EmailVerificationServiceException($msg, 0, $e);
        }
    }
}
