<?php


namespace think\route\traits;


trait DTOHelper
{

    /**
     * 将数组的值转换到类里面
     * @param object $dto
     * @param $vars
     * @return object
     */
    public function transformation(object $dto,$vars): object
    {
        $reflection = new \ReflectionClass($dto);

        $class_attributes = $reflection->getAttributes();
        foreach ($class_attributes as $class_attribute)
        {
            $class_attribute_object = $class_attribute->newInstance();
            if (method_exists($class_attribute_object,'handle'))
            {
                $class_attribute_object->handle($vars);
            }
        }

        $properties = $reflection->getProperties();

        foreach ($properties as $property)
        {
            // 成员名字
            $name = $property->getName();
            $attributes = $property->getAttributes();
            foreach ($attributes as $attribute)
            {
                $attribute_object = $attribute->newInstance();
                if (method_exists($attribute_object,'handle'))
                {
                    $params = [$name,$vars];
                    $attribute_object->handle(...$params);
                }
            }
            $property->setValue($dto,$vars[$name]??null);
        }
        return $dto;
    }
}