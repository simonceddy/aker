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
        $this->storeFile($file);
    }

    protected function storeFile(FileInterface $file)
    {
        $filename = $file->filename();
        $ext = $file->ext();
        if (null !== $ext
            && !\preg_match('/('.$ext.')$/', $filename)
        ) {
            $filename .= $ext;
        }
        if (preg_match('/\//', $filename)) {
            $dirs = explode('/', $filename);
            array_pop($dirs);
            $this->createSubDirs($dirs);
        }
        try {
            file_put_contents(
                $this->dir.'/'.$filename, $file->contents()
            );
        } catch (\Exception $e) {
            throw $e;
        }
    }

    protected function createSubDirs(array $dirs)
    {
        $current = $this->dir;
        foreach ($dirs as $dir) {
            if (!is_dir($current.'/'.$dir)) {
                mkdir($current.'/'.$dir);
            }
            $current = $current.'/'.$dir;
        }
    }

    public function load(string $filename)
    {
        if (!preg_match('/(\.json)$/', $filename)) {
            $filename .= '.json';
        }
        $file = $this->readFile($filename);
        return $file;
    }

    protected function readFile(string $filename)
    {
        if (!file_exists($path = $this->dir.'/'.$filename)) {
            throw new \InvalidArgumentException(
                'Could not locate a file at'.$path.'.'
            );
        }
        try {
            $contents = file_get_contents($path);
        } catch (\Exception $e) {
            throw $e;
        }
        return new JsonFile($filename, $contents);
    }
}
