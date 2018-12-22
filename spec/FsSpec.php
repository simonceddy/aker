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

    /* function it_can_save_a_file_from_file_interface(
        FileInterface $file
    ) {
        $file->filename()->willReturn('filename');
        $file->ext()->willReturn('.json');
        $file->filename()->shouldBeCalled();
        $file->contents()->shouldBeCalled();
        $file->ext()->shouldBeCalled();
        $this->save($file);
    } */

    function it_throws_logic_exception_when_saving_if_no_filename_is_set(
        FileInterface $file
    ) {
        $this->shouldThrow(\LogicException::class)->duringSave($file);
    }

    function it_can_load_a_file()
    {
        $file = $this->load('filename.json');
        $file->shouldBeAnInstanceOf(FileInterface::class);
        $file->filename()->shouldReturn('filename.json');
    }

    function it_can_create_sub_directories(FileInterface $file)
    {
        $file->filename()->willReturn('data/test');
        $file->ext()->willReturn('.json');
        $file->filename()->shouldBeCalled();
        $file->contents()->shouldBeCalled();
        $file->ext()->shouldBeCalled();
        $this->save($file)->shouldNotThrow(\Exception::class);
    }
}
