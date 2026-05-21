<?php

function currency_symbol()
{
    return match(auth()->user()->currency) {
        'USD' => '$',
        'EUR' => '€',
        'GBP' => '£',
        default => '₨',
    };
}
