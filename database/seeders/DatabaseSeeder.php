<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */


    public function run()
    {
        Storage::deleteDirectory('products');
        Storage::makeDirectory('products');
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Robert Xavier',
            'last_name' => 'Rivera',
            'document_type' => '1',
            'document_number' => '2400335119',
            'phone'=>'0997433070',
            'email' => 'rxrc1819@gmail.com',
            'password' => bcrypt('12345678')
        ]);

        $this->call([
            FamilySeeder::class,
            OptionSeeder::class,
        ]);
        Product::factory(150)->create();
    }
}
