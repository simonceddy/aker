<?php
namespace Eddy\Aker;

class Json
{
    public static function toArray(FileInterface $file)
    {
        return \json_decode($file, true);
    }

    public static function toArrayObject(FileInterface $file)
    {
        return new \ArrayObject(self::toArray($file));
    }

    public static function encode($contents, $flags = null)
    {
        return \json_encode($contents, $flags ?? JSON_PRETTY_PRINT);
    }

    public static function toJsonFile(string $filename, $contents = null)
    {
        try {
            $contents = self::encode($contents);
        } catch (\Exception $e) {
            throw $e;
        }
        return new JsonFile($filename, $contents);
    }
}
