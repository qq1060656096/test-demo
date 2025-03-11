<?php

namespace Tests\Tools3Tests;

use Yandex\Allure\Adapter\Allure;
use Yandex\Allure\Adapter\Event\TestCaseBrokenEvent;
use Yandex\Allure\Adapter\Event\TestCaseFailedEvent;
use Yandex\Allure\Adapter\Event\TestCaseFinishedEvent;
use Yandex\Allure\Adapter\Event\TestCaseStartedEvent;

trait AllureHelperTrait {


    /**
     * @param string $suiteUuid
     * @param string $name
     * @return TestCaseStartedEvent
     */
    public function newStartTestEvent($suiteUuid, $name)
    {
        return new TestCaseStartedEvent($suiteUuid, $name);
    }

    /**
     * A test started.
     * @param TestCaseStartedEvent $event
     * @return void
     * @throws \Yandex\Allure\Adapter\AllureException
     * @see self::newStartTestEvent()
     * @see self::endTest()
     */
    public function startTest(TestCaseStartedEvent $event)
    {
        Allure::lifecycle()->fire($event);
    }

    /**
     * An error occurred.
     * @return TestCaseBrokenEvent
     */
    public function newAddErrorEvent()
    {
        return new TestCaseBrokenEvent();
    }

    /**
     * An error occurred.
     *
     * @param TestCaseBrokenEvent $event
     * @return void
     * @throws \Yandex\Allure\Adapter\AllureException
     */
    public function addError(TestCaseBrokenEvent $event)
    {
        Allure::lifecycle()->fire($event);
    }

    /**
     * @return TestCaseFailedEvent
     */
    public function newAddFailureEvent()
    {
        return new TestCaseFailedEvent();
    }

    /**
     * A failure occurred.
     *
     * @param TestCaseFailedEvent $event
     * @return void
     * @throws \Yandex\Allure\Adapter\AllureException
     */
    public function addFailure(TestCaseFailedEvent $event)
    {
        Allure::lifecycle()->fire($event);
    }

    /**
     * A test ended.
     *
     * @throws \Exception
     */
    public function endTest()
    {
        Allure::lifecycle()->fire(new TestCaseFinishedEvent());
    }

    public function getMethodCaseName($methodName, $testCaseName) {
        $methodName = explode("\\", $methodName);
        $methodName = end($methodName);
        $arr = [
            $methodName,
            $testCaseName,
        ];
        return implode(': ', $arr);
    }

    public function getClassCaseName($className, $testCaseName) {
        $className = explode("\\", $className);
        $className = end($className);
        $arr = [
            $className,
            $testCaseName,
        ];
        return implode(': ', $arr);

    }
}
