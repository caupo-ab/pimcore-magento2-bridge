<?php
/**
 * @category    pimcore5-module-magento2-integration
 * @date        23/03/2018
 * @author      Michał Bolka <mbolka@divante.co>
 * @copyright   Copyright (c) 2018 DIVANTE (https://divante.co)
 */

namespace Divante\MagentoIntegrationBundle\Application\Mapper\Strategy;

use Divante\MagentoIntegrationBundle\Application\Mapper\Strategy\AbstractMapStrategy;
use Pimcore\Model\Webservice\Data\DataObject\Element;
use Divante\MagentoIntegrationBundle\Domain\Mapper\MapperHelper;

/**
 * Class MapObjectValue
 * @package Divante\MagentoIntegrationBundle\Domain\Mapper\Strategy
 */
class MapObjectValue extends AbstractMapStrategy
{
    const TYPE = 'object';
    const ALLOWED_TYPES_ARRAY = MapperHelper::OBJECT_TYPES;

    /**
     * @param Element     $field
     * @param \stdClass   $obj
     * @param array       $arrayMapping
     * @param string|null $language
     * @param mixed       $definition
     * @param string      $className
     */
    public function map(Element $field, \stdClass &$obj, array $arrayMapping, $language, $definition, $className): void
    {
        $names      = $this->getFieldNames($field, $arrayMapping);
        $parsedData = [
            'type'  => static::TYPE,
            'value' => $this->getFieldValue($field),
            'label' => $this->getLabel($field, $language),
            static::ATTR_CONF => $this->getAttrConf($field, $arrayMapping)
        ];

        foreach ($names as $name) {
            $thumbnail = $this->getThumbnail($field, $arrayMapping, $name);
            if ($thumbnail) {
                $parsedData["thumbnail"] = $thumbnail;
            }
            $obj->{$name} = $parsedData;
            unset($parsedData["thumbnail"]);
        }
    }


    /**
     * @param Element $field
     * @return array|object[]
     */
    protected function getFieldValue(Element $field)
    {
        if ($field->value) {
            if (in_array($field->type, MapperHelper::IMAGE_TYPES)) {
                return ['id' =>  $field->value, 'type' => 'asset'];
            } else {
                return $field->value;
            }
        }
    }
}
