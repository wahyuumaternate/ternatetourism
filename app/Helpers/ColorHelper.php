<?php

if (!function_exists('getSubjekColor')) {
    function getSubjekColor($subjek)
    {
        $colors = [
            'Informasi Wisata' => 'primary',
            'Bantuan Perjalanan' => 'info',
            'Saran & Masukan' => 'success',
            'Kerjasama' => 'warning',
            'Keluhan' => 'danger',
            'Lainnya' => 'secondary'
        ];
        return $colors[$subjek] ?? 'secondary';
    }
}

if (!function_exists('getStatusColor')) {
    function getStatusColor($status)
    {
        $colors = [
            'baru' => 'warning',
            'dibaca' => 'info',
            'diproses' => 'primary',
            'selesai' => 'success'
        ];
        return $colors[$status] ?? 'secondary';
    }
}
