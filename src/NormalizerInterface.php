<?php

namespace Adagio\Serializer;

interface NormalizerInterface
{
    /**
     *
     * @param mixed $data
     *
     * @return array
     */
    public function normalize($data): array;

    /**
     *
     * @param array $data
     * @param string|object $objectClass
     *
     * @return mixed
     */
    public function denormalize(array $data, $objectClass = \stdClass::class);
}
