# Thinkphp6 for DTO
## 安装 (php>=8.0)

```shell
composer require death_satan/think-dto -vvv
```

## 使用
### 创建DTO类

---
```php
<?php


namespace app\dto;


use think\route\annotation\Rule;
use think\route\annotation\Validate;

// 指定验证器对整个类所有的属性进行验证 第二个参数指定场景
#[Validate(\app\validate\Test::class)]
class Test
{
    // 也可以单独对某一个属性进行二次规则验证
    #[Rule(values: 'require')]
    public int $dto;
}
```
---

### 在控制器中使用

---
```php
<?php
namespace app\controller;

use app\BaseController;
use app\dto\Test;
use think\route\annotation\RequestBody;
use think\route\annotation\RequestQuery;

class Index extends BaseController
{
    // RequestQuery 将get参数放到test类属性中
    public function index(#[RequestQuery] Test $data)
    {
    }

    // RequestBody 将当前请求中的参数放到test类中
    public function test(#[RequestBody] Test $data)
    {

    }
}
```
---
