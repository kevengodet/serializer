<?php

namespace Adagio\Serializer;

interface EncoderInterface
{
    /**
     *
     * @param array $data
     *
     * @return string
     */
    public function encode(array $data): string;

    /**
     *
     * @param type $data
     *
     * @return array
     */
    public function decode(string $data): array;
}
