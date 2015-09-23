<?php /** MicroInterfaceValidator */

namespace Micro\validator;

use Micro\form\IFormModel;

/**
 * Interface IValidator
 *
 * @package Micro\validator
 *
 * @property array $elements
 * @property array $errors
 */
interface IValidator
{
    /**
     * Validate on server, make rule
     *
     * @access public
     *
     * @param IFormModel $model checked model
     *
     * @return bool
     * @throws \Micro\base\Exception
     */
    public function validate(IFormModel $model);

    /**
     * Client-side validation, make js rule
     *
     * @access public
     *
     * @param IFormModel $model model from elements
     *
     * @return string
     */
    public function client(IFormModel $model);
}
