<?php

namespace Rapidez\Account\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;
use Rapidez\Core\Facades\Rapidez;

class PasswordStrength extends Component
{
    public function render(): View
    {
        $length = Rapidez::config('customer/password/minimum_password_length');

        $extraChecks = [];

        if ($length > 1) {
            $extraChecks[] = [
                'text'  => __('Contains :length characters', ['length' => $length]),
                'regex' => '^.{'.$length.',}',
            ];
        }

        $classes = [
            [
                'text'  => __('Contains a lowercase letter'),
                'regex' => '[a-z]',
            ],
            [
                'text'  => __('Contains an uppercase letter'),
                'regex' => '[A-Z]',
            ],
            [
                'text'  => __('Contains a number'),
                'regex' => '[\d]',
            ],
            [
                'text'  => __('Contains a special character'),
                'regex' => '[^a-zA-Z0-9]',
            ],
        ];

        return view('rapidez::account.password-strength', compact('extraChecks', 'classes'));
    }
}
