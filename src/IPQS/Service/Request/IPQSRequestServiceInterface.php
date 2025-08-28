<?php

declare(strict_types=1);

namespace IPQS\Service\Request;

use IPQS\Service\Request\Constants\IPQSRequestTypeEnum;

interface IPQSRequestServiceInterface
{

    /**
     * @throws Exception\IPQSRequestServiceException
     */
    public function fetchOne(
        string|\Stringable $requestId,
        IPQSRequestTypeEnum|string|null $type
    ) : array;

}
