<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use App\Models\Poster;

class PosterSeeder extends Seeder
{
    public function run(): void
    {
        // Membaca file CSV dengan delimiter ;
        $csv = array_map(function($line) {
            return str_getcsv($line, ';');  // Menggunakan ; sebagai delimiter
        }, file(storage_path('app/seeds/posters.csv')));

        foreach ($csv as $index => $row) {
            if ($index === 0) continue; // skip header

            // Pastikan jumlah kolom sesuai dengan yang diinginkan
            if (count($row) < 5) {
                continue;  // skip malformed rows
            }

            [$title, $name, $email, $type, $fileUrl] = $row;

            $code = 'EP-' . str_pad($index, 4, '0', STR_PAD_LEFT);

            // Ambil file dari URL dan simpan di storage
            $filename = uniqid('poster_') . '.' . pathinfo($fileUrl, PATHINFO_EXTENSION);
            $content = file_get_contents($fileUrl);
            Storage::disk('public')->put("posters/{$filename}", $content);

            Poster::create([
                'code'      => $code,
                'name'      => $name,
                'title'     => $title,
                'email'     => $email,
                'type'      => $type,
                'affiliate' => null,
                'file'      => "posters/{$filename}",
            ]);
        }
    }
}
