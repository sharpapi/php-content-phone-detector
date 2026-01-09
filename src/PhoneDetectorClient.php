<?php

declare(strict_types=1);

namespace SharpAPI\ContentPhone;

use GuzzleHttp\Exception\GuzzleException;
use SharpAPI\Core\Client\SharpApiClient;

/**
 * Detect phone numbers in text using AI - extracts and formats phone numbers
 *
 * @package SharpAPI\ContentPhone
 * @api
 */
class PhoneDetectorClient extends SharpApiClient
{
    public function __construct(
        string $apiKey,
        ?string $apiBaseUrl = 'https://sharpapi.com/api/v1',
        ?string $userAgent = 'SharpAPIPHPContentPhone/1.0.0'
    ) {
        parent::__construct($apiKey, $apiBaseUrl, $userAgent);
    }

    /**
     * Detect phone numbers in text using AI - extracts and formats phone numbers
     *
     * @param string $content The text content to process
     * @return string Status URL for polling the job result
     * @throws GuzzleException
     * @api
     */
    public function detectPhones(
        string $content
    ): string {
        $response = $this->makeRequest('POST', '/content/detect_phones', array_filter([
            'content' => $content
        ], fn($v) => $v !== null));

        return $this->parseStatusUrl($response);
    }
}
