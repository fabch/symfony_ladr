<?php

namespace LADR\AddressBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Exception\ConstraintDefinitionException;

/**
 * Class ZipCode
 * @Annotation
 * @Target({"PROPERTY", "METHOD", "ANNOTATION"})
 */
class ZipCode extends Constraint
{
    public $message = 'Invalide {{ iso_code }} zip Code';
    public $iso_property;

    /**
     * {@inheritdoc}
     */
    public function __construct($options = null)
    {
        if (is_array($options) && !isset($options['iso_property'])) {
            throw new ConstraintDefinitionException(sprintf(
                'The %s constraint requires the "iso_property" option to be set.',
                get_class($this)
            ));
        }

        parent::__construct($options);
    }

    /**
     * {@inheritdoc}
     */
    public function getDefaultOption()
    {
        return 'iso_property';
    }
}