<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use App\Models\Poster;

class PosterSeeder extends Seeder
{
    public function run(): void
    {
        $csv = array_map(function($line) {
            return str_getcsv($line, ';');
        }, file(storage_path('app/seeds/posters.csv')));

        foreach ($csv as $index => $row) {
            if ($index === 0) continue;

            if (count($row) < 5) {
                continue;
            }

            [$title, $name, $email, $type, $fileUrl] = $row;

            $code = 'EP-' . str_pad($index, 4, '0', STR_PAD_LEFT);

            $filename = uniqid('poster_') . '.' . pathinfo($fileUrl, PATHINFO_EXTENSION);
            $fileUrl = preg_replace('/\s/', '%20', $fileUrl);
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
