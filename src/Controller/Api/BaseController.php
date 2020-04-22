<?php

namespace App\Controller\Api;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\SerializerInterface;

/**
 * Class BaseController
 * @package App\Controller\Api
 */
class BaseController extends AbstractController
{
    private $serializer;

    public function __construct(SerializerInterface $serializer)
    {
        $this->serializer = $serializer;
    }

    protected function jsonResponse($data, $groups, $code = null): Response
    {
        $status = Response::HTTP_OK;

        if ($code !== null) {
            $status = $code;
        }
        return new Response($this->serializer->serialize($data, 'json', ['groups' => $groups]), $status);
    }

    protected function jsonDeserialize($data, string $type, $groups, $objectToPopulate = null)
    {
        $context = ['groups' => $groups];

        if ($objectToPopulate !== null) {
            $context[AbstractNormalizer::OBJECT_TO_POPULATE] = $objectToPopulate;
        }
        return $this->serializer->deserialize($data, $type, 'json', $context);
    }
}
