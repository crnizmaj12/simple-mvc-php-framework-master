<?php


namespace Symfony\Component\HttpFoundation\File\Exception;

/**
 * Thrown when a file was not found.
 *
 * @author Bernhard Schussek <bschussek@gmail.com>
 */
class FileNotFoundException extends FileException
{
    public function __construct(string $path)
    {
        parent::__construct(sprintf('The file "%s" does not exist', $path));
    }
}
