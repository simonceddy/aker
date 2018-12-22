<?php
namespace Eddy\Aker;

class JsonFile implements FileInterface
{
    protected $filename;

    protected $contents;

    public function __construct(string $filename = null, $contents = null)
    {
        null === $filename ?: $this->setFilename($filename);
        null === $contents ?: $this->setContents($contents);
    }

    public function setFilename(string $name)
    {
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

    public function __toString()
    {
        return (string) $this->contents;
    }

    public function ext()
    {
        return '.json';
    }
}
