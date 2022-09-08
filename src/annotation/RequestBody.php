<?php


namespace think\route\annotation;

use Attribute;
use think\route\traits\DTOHelper;

#[Attribute(Attribute::TARGET_PARAMETER)]
class RequestBody extends BaseAnnotation
{
    use DTOHelper;

    public function handle(object $dto):object
    {
        return $this->transformation($dto,request()->param());
    }
}