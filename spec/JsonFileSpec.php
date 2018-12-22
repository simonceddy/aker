<?php

namespace spec\Eddy\Aker;

use Eddy\Aker\JsonFile;
use Eddy\Aker\FileInterface;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class JsonFileSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType(JsonFile::class);
    }

    function it_implements_file_interface()
    {
        $this->shouldHaveType(FileInterface::class);
    }

    function it_returns_null_if_no_filename_is_set()
    {
        $this->filename()->shouldBeNull();
    }

    function it_can_set_a_filename()
    {
        $this->setFilename('test');
        $this->filename()->shouldReturn('test');
    }

    function it_returns_contents_when_used_as_a_string()
    {
        $this->setContents('test');
        $this->__toString()->shouldReturn('test');
    }
}
