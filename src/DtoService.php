<?php


namespace think\route;


use think\route\annotation\RequestBody;
use think\route\annotation\RequestQuery;

class DtoService extends \think\Service
{

    private array $annotations = [
        RequestBody::class,
        RequestQuery::class,
    ];

    public function register(): void
    {
        // 全局绑定，只实例化一次注解对象 减少开销
        foreach ($this->annotations as $annotation)
        {
            $this->app->bind($annotation,function ()use ($annotation){
                return $this->app->invokeClass($annotation);
            });
        }
    }
}