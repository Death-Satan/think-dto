<?php


namespace think\route\annotation;

use think\Exception;

#[\Attribute(\Attribute::TARGET_CLASS)]
class Validate
{
    /**
     * Validate constructor.
     * @param string $validate 验证器类名
     * @param string|null $scene 场景,不传则全部验证
     */
    public function __construct(public string $validate,public ?string $scene = null)
    {
        if (!class_exists($this->validate))
        {
            throw new Exception('验证器类:['.$this->validate.']不存在');
        }
    }

    public function handle($vars)
    {
        $validate = validate($this->validate)->failException();
        if ($this->scene !== null)
        {
            $validate = $validate->scene($this->scene);
        }
        $validate->check($vars);
    }
}