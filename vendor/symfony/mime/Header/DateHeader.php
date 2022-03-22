<?php


namespace Symfony\Component\Mime\Header;

/**
 * A Date MIME Header.
 *
 * @author Chris Corbyn
 */
final class DateHeader extends AbstractHeader
{
    private $dateTime;

    public function __construct(string $name, \DateTimeInterface $date)
    {
        parent::__construct($name);

        $this->setDateTime($date);
    }

    /**
     * @param \DateTimeInterface $body
     */
    public function setBody($body)
    {
        $this->setDateTime($body);
    }

    public function getBody(): \DateTimeImmutable
    {
        return $this->getDateTime();
    }

    public function getDateTime(): \DateTimeImmutable
    {
        return $this->dateTime;
    }

    /**
     * Set the date-time of the Date in this Header.
     *
     * If a DateTime instance is provided, it is converted to DateTimeImmutable.
     */
    public function setDateTime(\DateTimeInterface $dateTime)
    {
        if ($dateTime instanceof \DateTime) {
            $immutable = new \DateTimeImmutable('@'.$dateTime->getTimestamp());
            $dateTime = $immutable->setTimezone($dateTime->getTimezone());
        }
        $this->dateTime = $dateTime;
    }

    public function getBodyAsString(): string
    {
        return $this->dateTime->format(\DateTime::RFC2822);
    }
}
