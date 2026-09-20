<?php

namespace App\Helpers;

class RichText
{
    /**
     * Bersihkan HTML dari editor (TinyMCE) sebelum ditampilkan.
     *
     * Format dari editor disimpan sebagai atribut style inline, jadi dibiarkan apa adanya.
     * Yang dibuang: class dan data-* (hasil paste sering membawa class seperti "flex" atau
     * "hidden" yang bentrok dengan CSS situs), script, handler on*, dan tautan javascript:.
     * Heading h1 diturunkan ke h2 agar halaman hanya punya satu h1, dan tabel dibungkus agar bisa digulir
     * secara horizontal di layar sempit.
     */
    public static function clean(?string $html): string
    {
        if (blank($html)) {
            return '';
        }

        $html = preg_replace('#<script\b[^>]*>.*?</script>#is', '', $html);
        $html = preg_replace('/\son\w+\s*=\s*("[^"]*"|\'[^\']*\')/i', '', $html);
        $html = preg_replace('/\s(?:class|data-[\w-]+)\s*=\s*("[^"]*"|\'[^\']*\')/i', '', $html);
        $html = preg_replace('/\b(href|src)\s*=\s*(["\'])\s*javascript:[^"\']*\2/i', '$1=$2#$2', $html);

        $html = preg_replace(['#<h1\b#i', '#</h1>#i'], ['<h2', '</h2>'], $html);

        // Tabel lebar bergulir sendiri di dalam pembungkusnya, tidak melebarkan halaman
        return preg_replace(['#<table\b#i', '#</table>#i'], ['<div class="rich-table"><table', '</table></div>'], $html);
    }
}
