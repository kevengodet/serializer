<?php

namespace Adagio\Serializer;

final class JsonEncoder implements EncoderInterface
{
    /**
     *
     * @param array $data
     *
     * @return string
     */
    public function encode(array $data): string
    {
        return json_encode($data, JSON_PRETTY_PRINT);
    }

    /**
     *
     * @param type $data
     *
     * @return array
     */
    public function decode(string $data): array
    {
        return json_decode($data, true);
    }
}
