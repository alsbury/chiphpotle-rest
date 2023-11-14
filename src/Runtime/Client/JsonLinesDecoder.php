<?php

namespace Chiphpotle\Rest\Runtime\Client;

use Symfony\Component\Serializer\Encoder\DecoderInterface;

/**
 * Decodes JSON lines formatted responses
 *
 * @see https://jsonlines.org/
 */
final class JsonLinesDecoder implements DecoderInterface
{
    public const FORMAT = 'jsonl';

    public function __construct(private readonly DecoderInterface $jsonDecoder)
    {
    }

    public function decode(string $data, string $format, array $context = []): array
    {
        $decodedData = [];
        foreach (explode("\n", $data) as $line) {
            if (!empty($line)) {
                $decodedData[] = $this->jsonDecoder->decode($line, $format, $context);
            }
        }
        return $decodedData;
    }

    public function supportsDecoding(string $format): bool
    {
        return self::FORMAT === $format;
    }
}
