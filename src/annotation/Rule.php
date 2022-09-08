<?php


namespace think\route\annotation;

use think\facade\Validate;

#[\Attribute(\Attribute::TARGET_PROPERTY)]
class Rule
{
    /**
     * Rule constructor.
     * @param string|array $values 验证规则
     * @param array $messages 单独定义提示信息
     */
    public function __construct(public string|array $values,public array $messages = [])
    {

    }

    public function handle($name,$data)
    {
        $rules =[
            $name => $this->values
        ];
        $validate = \validate($rules,$this->messages)->failException();
        $validate->check($data,$rules);
    }
}

