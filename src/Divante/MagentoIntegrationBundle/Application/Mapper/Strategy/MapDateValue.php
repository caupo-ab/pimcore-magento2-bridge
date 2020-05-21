<?php
/**
 * @category    pimcore5-module-magento2-integration
 * @date        22/03/2018
 * @author      Michał Bolka <mbolka@divante.co>
 * @copyright   Copyright (c) 2018 DIVANTE (https://divante.co)
 */

namespace Divante\MagentoIntegrationBundle\Application\Mapper\Strategy;

use Divante\MagentoIntegrationBundle\Domain\Mapper\MapperHelper;
use Divante\MagentoIntegrationBundle\Application\Mapper\Strategy\MapTextValue;

/**
 * Class MapDateValue
 * @package Divante\MagentoIntegrationBundle\Domain\Mapper\Strategy
 */
class MapDateValue extends MapTextValue
{
    const TYPE = 'datetime';
    const ALLOWED_TYPES_ARRAY = MapperHelper::DATE_TYPES;
}