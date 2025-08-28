<?php

declare(strict_types=1);

namespace IPQS\Service\Request;

use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Psr7\Uri;
use IPQS\IPQSConstants;
use IPQS\Service\Request\Constants\IPQSRequestTypeEnum;

readonly class IPQSRequestService implements IPQSRequestServiceInterface
{
    private const string API_ENDPOINT = 'json/postback/:key?type=:type&request_id=:request_id';

    public function __construct(
        private ClientInterface $client,
        private string $key
    ) {
    }

    /**
     * @throws Exception\IPQSRequestServiceException
     */
    public function fetchOne(
        string|\Stringable $requestId,
        IPQSRequestTypeEnum|string|null $type,
    ): array
    {
        if(is_string($type)){
            $type = IPQSRequestTypeEnum::fromValue($type);
        }

        $auto = null === $type;
        $types = null === $type ? IPQSRequestTypeEnum::cases() : [$type];
        $errorMsg = 'Failed to obtain IPQS request id';

        foreach($types as $t){
            try {
                return $this->_fetchOne($requestId, $t);
            }catch(\Throwable $e){
                false === $auto && throw new Exception\IPQSRequestServiceException($errorMsg, 0, $e);
            }
        }

        throw new Exception\IPQSRequestServiceException($errorMsg);
    }

    //<editor-fold desc="Private methods">
    /**
     * @throws GuzzleException
     * @throws \JsonException
     */
    private function _fetchOne(
        string|\Stringable $requestId,
        IPQSRequestTypeEnum $type,
    ){
        $path = strtr(self::API_ENDPOINT, [
            ':key' => $this->key,
            ':type' => $type->value,
            ':request_id' => (string)$requestId
        ]);

        $uri = new Uri(sprintf('%s/%s', IPQSConstants::API_URL, $path));

        $response = $this->client->request('POST', $uri, [
            'headers' => [
                'User-Agent' => sprintf('pthreat/IPQS Version: %s', IPQSConstants::VERSION)
            ]
        ]);

        return json_decode($response->getBody()->getContents(),true, 512, \JSON_THROW_ON_ERROR);
    }
    //</editor-fold>

}
