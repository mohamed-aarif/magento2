<?php
/**
 * Copyright © 2013-2017 Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\Framework\Exception;

use Magento\Framework\Phrase;

/**
 * Exception to be thrown when there is an issue with the Input to a function call.
 */
class InputException extends AbstractAggregateException
{
    const DEFAULT_MESSAGE = 'One or more input exceptions have occurred.';
    const INVALID_FIELD_RANGE = 'The %fieldName value of "%value" must be between %minValue and %maxValue';
    const INVALID_FIELD_MIN_VALUE = 'The %fieldName value of "%value" must be greater than or equal to %minValue.';
    const INVALID_FIELD_MAX_VALUE = 'The %fieldName value of "%value" must be less than or equal to %maxValue.';
    const INVALID_FIELD_VALUE = 'Invalid value of "%value" provided for the %fieldName field.';
    const REQUIRED_FIELD = '%fieldName is a required field.';

    /**
     * Initialize the input exception.
     *
     * @param \Magento\Framework\Phrase $phrase
     * @param \Exception $cause
     */
    public function __construct(Phrase $phrase = null, \Exception $cause = null)
    {
        if ($phrase === null) {
            $phrase = new Phrase(self::DEFAULT_MESSAGE);
        }
        parent::__construct($phrase, $cause);
    }

    /**
     * Creates an InputException for when a specific field was provided with an invalid value.
     *
     * @param string $fieldName Name of the field which had an invalid value provided.
     * @param string $fieldValue The invalid value that was provided for the field.
     * @param \Exception $cause   Cause of the InputException
     * @return \Magento\Framework\Exception\InputException
     */
    public static function invalidFieldValue($fieldName, $fieldValue, \Exception $cause = null)
    {
        return new self(
            new Phrase(self::INVALID_FIELD_VALUE, ['fieldName' => $fieldName, 'value' => $fieldValue]),
            $cause
        );
    }

    /**
     * Creates an InputException for a missing required field.
     *
     * @param string $fieldName Name of the missing required field.
     * @return \Magento\Framework\Exception\InputException
     */
    public static function requiredField($fieldName)
    {
        return new self(
            new Phrase(self::REQUIRED_FIELD, ['fieldName' => $fieldName])
        );
    }
}
