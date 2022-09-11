<?php

namespace App\Doctrine\Mapping;

use Doctrine\ORM\Mapping\DefaultNamingStrategy;

class CamelCaseNamingStrategy extends DefaultNamingStrategy
{
    public function embeddedFieldToColumnName(
        $propertyName,
        $embeddedColumnName,
        $className = null,
        $embeddedClassName = null
    ): string {
        return $propertyName.ucfirst($embeddedColumnName);
    }

    public function joinColumnName($propertyName, $className = null): string
    {
        return $propertyName.ucfirst($this->referenceColumnName());
    }

    public function joinTableName($sourceEntity, $targetEntity, $propertyName = null): string
    {
        return $this->classToTableName($sourceEntity).ucfirst($this->classToTableName($targetEntity));
    }

    public function joinKeyColumnName($entityName, $referencedColumnName = null): string
    {
        if (null === $referencedColumnName) {
            $referencedColumnName = $this->referenceColumnName();
        }

        return lcfirst($this->classToTableName($entityName).ucfirst($referencedColumnName));
    }
}
