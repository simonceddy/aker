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

    public static function encode($contents, int $options = null)
    {
        try {
            $contents = \json_encode($contents, $options ?? JSON_PRETTY_PRINT);
        } catch (\Exception $e) {
            throw $e;
        }
        return $contents;
    }

    public static function toFile(string $filename, $contents = null)
    {
        return new JsonFile($filename, self::encode($contents));
    }
}
