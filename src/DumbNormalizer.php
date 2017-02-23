<?php

namespace Adagio\Serializer;

use JsonMapper;

final class DumbNormalizer implements NormalizerInterface
{
    /**
     *
     * @var JsonMapper
     */
    private $mapper;

    /**
     *
     * @param JsonMapper $mapper
     */
    public function __construct(JsonMapper $mapper = null)
    {
        if (is_null($mapper)) {
            $mapper = new JsonMapper;
            $mapper->bStrictObjectTypeChecking = true;
            $mapper->bEnforceMapType = false;
            $mapper->undefinedPropertyHandler = function($object, $propName, $jsonValue) {
                $object->{$propName} = $jsonValue;
            };
        }

        $this->mapper = $mapper;
    }

    /**
     *
     * @param mixed $data
     *
     * @return array
     */
    public function normalize($data): array
    {
        return $this->doNormalize($data, true);
    }

    /**
     *
     * @staticvar array $refs
     *
     * @param mixed $data
     * @param bool $resetRefs
     * @param array $options
     *
     * @return array
     *
     * @throws InvalidArgumentException
     * @throws RuntimeException
     */
    private function doNormalize($data, bool $resetRefs = false, array $options = [ 'recursion_token' => '* RECURSION *'])
    {
        static $refs = [];

        if ($resetRefs) {
            $refs = [];
        }

        if (is_null($data)) {
            return null;
        }
        if (is_resource($data)) {
            throw new \InvalidArgumentException('Resources cannot be converted to array.');
        }

        if (is_array($data)) {
            return $this->arrayMapClean(__METHOD__, $data);
        }

        if (is_scalar($data)) {
            return $data;
        }

        if (is_object($data)) {
            $oid = spl_object_hash($data);
            if (isset($refs[$oid])) {
                if (false !== $options['recursion_token']) {
                    return $options['recursion_token'];
                }
                throw new \InvalidArgumentException('Recursion detected.');
            }

            $refs[$oid] = true;

            return $this->arrayMapClean(__METHOD__, (array) $data);
        }

        throw new \RuntimeException('Wasn\'t expecting a var of type '.gettype($data));
    }

    /**
     *
     * @param callable $callable
     * @param array $data
     *
     * @return array
     */
    private function arrayMapClean(callable $callable, array $data)
    {
        return array_combine(
            array_map(function($str) { return preg_replace('/(\0.+\0)/', '', $str); }, array_keys($data)),
            array_map($callable, $data)
        );
    }

    /**
     *
     * @param array $data
     * @param string|object $objectClass
     *
     * @return mixed
     */
    public function denormalize(array $data, $objectClass = \stdClass::class)
    {
        $object = is_object($objectClass) ?
                $objectClass :
                (new \ReflectionClass($objectClass))->newInstanceWithoutConstructor();

        return $this->mapper->map($data, $object);
    }
}
