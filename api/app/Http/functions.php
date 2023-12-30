<?php
use Carbon\Carbon;

if(!function_exists('dateFormat')){
    function dateFormat($tarihStr) {
        // Verilen tarihi 'YYYY-MM-DD' formatında Carbon nesnesine çevir
        $tarihObj = Carbon::createFromFormat('Y-m-d', $tarihStr);

        // Türkçe gün ismi için gün adları listesi
        $gunAdiListesi = ["Pazartesi", "Salı", "Çarşamba", "Perşembe", "Cuma", "Cumartesi", "Pazar"];

        // Tarihin gün numarasını al ve gün adını bul
        $gunNumarasi = $tarihObj->dayOfWeek;
        $gunAdi = $gunAdiListesi[$gunNumarasi];

        // Türkçe ay ismi için ay adları listesi
        $ayAdiListesi = ["", "Ocak", "Şubat", "Mart", "Nisan", "Mayıs", "Haziran", "Temmuz", "Ağustos", "Eylül", "Ekim", "Kasım", "Aralık"];

        // Tarihin ay numarasını al ve ay adını bul
        $ayNumarasi = $tarihObj->month;
        $ayAdi = $ayAdiListesi[$ayNumarasi];

        // Formatlı tarih ve gün adını birleştir
        $formatliTarih = $tarihObj->format("d ") . $ayAdi . $tarihObj->format(" Y, ") . $gunAdi;

        return $formatliTarih;
    }
}

if (!function_exists('monthTr2En')) {
    function monthTr2En($date) {
        return str_replace(["Ocak", "Şubat", "Mart", "Nisan", "Mayıs", "Haziran", "Temmuz", "Ağustos", "Eylül", "Ekim", "Kasım", "Aralık"],["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],$date);
    }
}

if (!function_exists('uuid')) {
    function uuid() {
        return sprintf(
            '%04x%04x-%04x-%04x-%04x-%04x%04x%04x',
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0x0fff) | 0x4000, mt_rand(0, 0x3fff) | 0x8000,
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff),
            mt_rand(0, 0xffff)
        );
    }
}
