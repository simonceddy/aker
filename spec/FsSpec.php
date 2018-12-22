<?php

namespace spec\Eddy\Aker;

use Eddy\Aker\Fs;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use Eddy\Aker\FileInterface;

class FsSpec extends ObjectBehavior
{
    function let()
    {
        $this->beConstructedWith(dirname(__DIR__));
    }

    function it_is_initializable()
    {
        $this->shouldHaveType(Fs::class);
    }

    function it_crashes_if_an_invalid_dir_is_passed()
    {
        $this->shouldThrow(\InvalidArgumentException::class)
            ->duringSetDir(dirname(__DIR__).'/asdjalsdjad');
    }

    function it_can_return_the_set_directory_path()
    {
        $this->dir()->shouldBeEqualTo(dirname(__DIR__));
    }

    function it_gets_the_filename_from_the_file_object_when_saving(
        FileInterface $file
    ) {
        $file->filename()->willReturn('filename.json');
        $file->filename()->shouldBeCalled();
        $this->save($file);
    }

    function it_throws_logic_exception_when_saving_if_no_filename_is_set(
        FileInterface $file
    ) {
        $this->shouldThrow(\LogicException::class)->duringSave($file);
    }
}
