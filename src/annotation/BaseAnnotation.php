<?php


namespace think\route\annotation;


abstract class BaseAnnotation
{
    abstract public function handle(object $dto):object;
}