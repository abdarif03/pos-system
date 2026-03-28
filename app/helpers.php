<?php

declare(strict_types=1);

if (! function_exists('format_idr')) {
    /**
     * Indonesian Rupiah display: "Rp 1.234.567" (no sen).
     */
    function format_idr(float|int|string|null $amount): string
    {
        return 'Rp '.number_format((float) $amount, 0, ',', '.');
    }
}

if (! function_exists('format_id_number')) {
    /**
     * Indonesian number grouping: ribuan ".", desimal "," (e.g. counts, margin %).
     */
    function format_id_number(float|int|string|null $number, int $decimals = 0): string
    {
        return number_format((float) $number, $decimals, ',', '.');
    }
}
