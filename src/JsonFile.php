<?php
namespace Eddy\Aker;

class JsonFile
{
    protected $filename;

    protected $contents;

    public function __construct(string $filename = null, $contents = null)
    {

    }

    public function setFilename(string $name)
    {
        if (!preg_match('/(\.json)$/', $name)) {
            $name .= '.json';
        }
        $this->filename = $name;
    }

    public function filename()
    {
        return $this->filename;
    }

    public function setContents(string $contents)
    {
        $this->contents = $contents;
        return $this;
    }

    public function contents()
    {
        return $this->contents;
    }

    public function saveTo(string $dir)
    {
        if (!is_dir($dir)) {
            throw new \InvalidArgumentException(
                $dir.' could not be located'
            );
        }
    }
}
