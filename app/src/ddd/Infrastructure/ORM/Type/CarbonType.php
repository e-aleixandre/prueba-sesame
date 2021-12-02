<?php

namespace App\ddd\Infrastructure\ORM\Type;

use Carbon\CarbonImmutable;
use Carbon\CarbonInterface;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\ConversionException;
use Doctrine\DBAL\Types\DateTimeType;

class CarbonType extends DateTimeType
{
    const CARBON_DATETIME = 'carbon';

    public function getName()
    {
        return static::CARBON_DATETIME;
    }

    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        return 'CHAR(25)';
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if (null === $value) {
            return null;
        }

        if ($value instanceof CarbonInterface) {
            return $value->format('c');
        }

        throw ConversionException::conversionFailedInvalidType($value, $this->getName(), ['null', 'DateTime']);
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        if (null === $value)
            return null;

        return new CarbonImmutable($value);
    }

    public function requiresSQLCommentHint(AbstractPlatform $platform)
    {
        return true;
    }

}
