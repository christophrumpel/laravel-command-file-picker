<?php

namespace Christophrumpel\LaravelCommandFilePicker\Tests;

use PHPUnit\Framework\TestCase;

class LoadingFromOtherClassesTest extends TestCase
{

    private $traitMock;

    protected function setUp() : void
    {
        $this->traitMock = $this->getMockForTrait('Christophrumpel\LaravelCommandFilePicker\Traits\PicksClasses');
    }

    /** @test */
    public function it_getting_models_as_collection()
    {
        $result = $this->invokeMethod($this->traitMock,'loadModels',[__DIR__.'/Data/Models']);
        $result = $this->invokeMethod($result,'toCollection');
        $this->assertTrue($result instanceof \Illuminate\Support\Collection);
    }

    public function invokeMethod(&$object, $methodName, array $parameters = [])
    {
        $reflection = new \ReflectionClass(get_class($object));
        $method = $reflection->getMethod($methodName);
        $method->setAccessible(true);

        return $method->invokeArgs($object, $parameters);
    }
}
