<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        \App\Models\Vocabulary::create([
            'word' => "absolute",
            'definition' => "very great or to the largest degree possible\nused when expressing a strong opinion",
            'example' => "I have absolute faith in her judgment\nHe's an absolute idiot!",
            'level' => "x1",
            'part_of_speech' => "adjective",
            'transcription' => " /ˈæb.sə.luːt/",
            'translation' => "абсолютный"
        ]);
        \App\Models\Vocabulary::create([

            'word' => 'accept',
            'definition' => 'to agree to take something',
            'example' => 'Do you accept credit cards?\nShe was in Mumbai to accept an award for her latest novel',
            'level' => 'x1',
            'part_of_speech' => 'verb',
            'transcription' => '/əkˈsept/',
            'translation' => 'принять',
        ]);

    }
}
