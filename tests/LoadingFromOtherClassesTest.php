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
        $result = $this->traitMock->loadModels(__DIR__.'/Data/Models')->toCollection();

        $this->assertTrue($result instanceof \Illuminate\Support\Collection);
    }
}
