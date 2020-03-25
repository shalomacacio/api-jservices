<?php

namespace App\Validators;

use \Prettus\Validator\Contracts\ValidatorInterface;
use \Prettus\Validator\LaravelValidator;

/**
 * Class PlanValidator.
 *
 * @package namespace App\Validators;
 */
class PlanValidator extends LaravelValidator
{
    /**
     * Validation Rules
     *
     * @var array
     */
    protected $rules = [
        ValidatorInterface::RULE_CREATE => [
            'descricao' => 'required | unique:planos'
        ],
        ValidatorInterface::RULE_UPDATE => [],
    ];
}
