<?php

namespace spec\Eddy\Aker;

use Eddy\Aker\JsonFile;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class JsonFileSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(JsonFile::class);
    }

    function it_can_set_a_filename()
    {
        $this->setFilename('test');
        $this->filename()->shouldReturn('test.json');
    }
}
