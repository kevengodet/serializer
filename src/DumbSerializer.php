<?php

namespace Adagio\Serializer;

final class DumbSerializer implements SerializerInterface
{
    /**
     *
     * @var NormalizerInterface
     */
    private $normalizer;

    /**
     *
     * @var EncoderInterface
     */
    private $encoder;

    /**
     *
     * @param NormalizerInterface $normalizer
     * @param EncoderInterface $encoder
     */
    public function __construct(NormalizerInterface $normalizer = null, EncoderInterface $encoder = null)
    {
        $this->normalizer = $normalizer ?? new DumbNormalizer;
        $this->encoder = $encoder ?? new JsonEncoder;
    }

    /**
     *
     * @param mixed $data
     *
     * @return string
     */
    public function serialize($data): string
    {
        return $this->encoder->encode($this->normalizer->normalize($data));
    }

    /**
     *
     * @param string $serializedData
     * @param string|object $objectClass
     *
     * @return mixed
     */
    public function deserialize(string $serializedData, $objectClass = \stdClass::class)
    {
        return $this->normalizer->denormalize($this->encoder->decode($serializedData), $objectClass);
    }
}
