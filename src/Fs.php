<?php
namespace Eddy\Aker;

class Fs
{
    protected $dir;

    public function __construct(string $dir)
    {
        $this->setDir($dir);
    }

    public function setDir(string $dir)
    {
        if (!is_dir($dir)) {
            throw new \InvalidArgumentException('Could not locate '.$dir.'.');
        }
        $this->dir = $dir;
        return $this;
    }

    public function dir()
    {
        // TODO: write logic here
        return $this->dir;
    }

    public function save(FileInterface $file)
    {
        if (!$file->filename()) {
            throw new \LogicException('No filename is specified.');
        }
        if (!isset($this->dir)) {

        }
    }
}
