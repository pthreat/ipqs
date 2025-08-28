<?php

declare(strict_types=1);

namespace IPQS\Service\Device;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Uri;
use IPQS\IPQSConstants;
use IPQS\Options\IPQSVerificationOptionsInterface;
use IPQS\Service\Device\Options\DeviceVerificationOptionsInterface;
use IPQS\Service\Device\Response\DeviceVerificationResponse;
use IPQS\Service\Device\Response\DeviceVerificationResponseInterface;
use IPQS\Service\Request\Constants\IPQSRequestTypeEnum;
use IPQS\Service\Request\Exception\IPQSRequestServiceException;
use IPQS\Service\Request\IPQSRequestService;
use IPQS\Service\Request\IPQSRequestServiceInterface;

readonly class DeviceVerificationService implements DeviceVerificationServiceInterface
{
    private const string API_ENDPOINT = 'tracker/results/:key/:ip/:fingerprint';

    public function __construct(
        private ClientInterface $client,
        private string $key,
        private IPQSRequestServiceInterface|null $requestService=null
    ) {
    }

    public function getByRequestId(string $requestId) : array
    {
        try {
            return ($this->requestService ?? new IPQSRequestService(client: $this->client, key: $this->key))->fetchOne(
                type: IPQSRequestTypeEnum::DEVICE,
                requestId: $requestId
            );
        }catch(IPQSRequestServiceException $e){
            $msg = 'Failed to obtain request id response for device tracker';
            throw new Exception\DeviceVerificationServiceException($msg, 0, $e);
        }
    }

    public function verify(
        string|\Stringable $value,
        IPQSVerificationOptionsInterface $options
    ): DeviceVerificationResponseInterface {

        if (!$options instanceof DeviceVerificationOptionsInterface) {
            $msg = sprintf('Given options is not an instance of: %s', DeviceVerificationOptionsInterface::class);
            throw new \InvalidArgumentException($msg);
        }

        $path = strtr(self::API_ENDPOINT, [
            ':key' => $this->key,
            ':ip' => (string) $value,
            ':fingerprint' => $options->getFingerprint()
        ]);

        $uri = new Uri(sprintf('%s/%s', IPQSConstants::API_URL, $path));

        try {
            $response = $this->client->request('GET', $uri, [
                'headers' => [
                    'User-Agent' => sprintf('pthreat/IPQS Version: %s', IPQSConstants::VERSION)
                ]
            ]);

            return DeviceVerificationResponse::fromJSON($response->getBody()->getContents());
        } catch (GuzzleException|\JsonException $e) {
            $msg = 'Failed to perform device tracking verification';
            throw new Exception\DeviceVerificationServiceException($msg, 0, $e);
        }
    }
}
