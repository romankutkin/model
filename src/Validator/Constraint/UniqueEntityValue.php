<?php

declare(strict_types=1);

namespace App\Validator\Constraint;

use Symfony\Component\Validator\Constraint;

/**
 * Constraint for the unique entity value validator.
 */
#[\Attribute()]
class UniqueEntityValue extends Constraint
{
    public const NOT_UNIQUE_VALUE_ERROR = '3ecf7987-ee6a-4739-b4c5-dde7556a2011';

    protected static $errorNames = [
        self::NOT_UNIQUE_VALUE_ERROR => 'NOT_UNIQUE_VALUE_ERROR',
    ];

    public string $message = "This value already exists.";

    /**
     * Fully qualified name of an entity class.
     */
    public string $entity;

    /**
     * Field name of an entity.
     */
    public string $field;

    public function __construct($options = null, array $groups = null, $payload = null)
    {
        parent::__construct($options, $groups, $payload);

        $this->entity = $options['entity'];
        $this->field = $options['field'];

        $this->message = $options['message'] ?? $this->message;
    }

    public function getRequiredOptions(): array
    {
        return ['entity', 'field'];
    }
}
