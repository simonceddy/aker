<?php
namespace Eddy\Aker;

interface FileInterface
{
    public function setFilename(string $name);

    public function filename();

    public function setContents(string $contents);

    public function contents();

    public function ext();
}
