<?php

namespace Adagio\Serializer;

interface SerializerInterface
{
    /**
     *
     * @param mixed $data
     *
     * @return string
     */
    public function serialize($data): string;

    /**
     *
     * @param string $serializedData
     * @param string|object $objectClass
     *
     * @return mixed
     */
    public function deserialize(string $serializedData, $objectClass = \stdClass::class);
}
