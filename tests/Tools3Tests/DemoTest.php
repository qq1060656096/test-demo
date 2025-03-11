<?php
namespace Tests\Tools3Tests;

use Tests\TestCase;
use Tests\Tools3Tests\AllureHelperTrait;
use Yandex\Allure\Adapter\Annotation\AllureId;
use Yandex\Allure\Adapter\Annotation\Issues;
use Yandex\Allure\Adapter\Annotation\Title;
use Yandex\Allure\Adapter\Annotation\Description;
use Yandex\Allure\Adapter\Annotation\Features;
use Yandex\Allure\Adapter\Annotation\Stories;
use Yandex\Allure\Adapter\Annotation\Severity;
use Yandex\Allure\Adapter\Annotation\Label;
use Yandex\Allure\Adapter\Annotation\Labels;
use Yandex\Allure\Adapter\Annotation\Parameter;
use Yandex\Allure\Adapter\Model\DescriptionType;
use Yandex\Allure\Adapter\Model\SeverityLevel;
use Yandex\Allure\Adapter\Model\ParameterKind;
use Yandex\Allure\Adapter\Support\StepSupport;

/**
 * @Title("测试")
 * @Features ({"allure"})
 */
class DemoTest extends TestCase
{
    use AllureHelperTrait;


    /**
     * @Title("断言Ok")
     */
    public function testOk()
    {
        $this->assertTrue(true);
    }

}