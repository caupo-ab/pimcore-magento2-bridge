<?php

namespace Divante\MagentoIntegrationBundle\Action\Mapper;

use Divante\MagentoIntegrationBundle\Application\Mapper\MapperManager;
use Divante\MagentoIntegrationBundle\Responder\JsonResponder;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class MapperAddRow
 * @package Divante\MagentoIntegrationBundle\Action\Admin
 * @Route("/mappings/add-row/{type}")
 */
class AddRowAction
{
    /** @var MapperManager  */
    private $domain;

    /** @var JsonResponder */
    private $responder;

    /**
     * SendCategoriesAction constructor.
     * @param MapperManager $domain
     * @param JsonResponder $jsonResponder
     */
    public function __construct(MapperManager $domain, JsonResponder $jsonResponder)
    {
        $this->domain = $domain;
        $this->responder = $jsonResponder;
    }

    /**
     * @param Request $query
     * @return JsonResponse
     * @throws \Exception
     */
    public function __invoke(Request $query): JsonResponse
    {
        $this->domain->addRow($query->request->get("id"), $query->get('type'));
        return $this->responder->createResponse([]);
    }
}