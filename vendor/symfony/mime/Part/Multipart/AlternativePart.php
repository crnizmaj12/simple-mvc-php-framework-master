<?php


namespace Symfony\Component\Mime\Part\Multipart;

use Symfony\Component\Mime\Part\AbstractMultipartPart;

/**
 * @author Miloš Ćorlomanović <office.inint@gmail.com>
 */
final class AlternativePart extends AbstractMultipartPart
{
    public function getMediaSubtype(): string
    {
        return 'alternative';
    }
}
