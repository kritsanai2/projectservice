<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Movie; // นำเข้าโมเดล Movie
use Faker\Factory as Faker; // นำเข้า Faker

class MovieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create(); // สร้าง instance ของ Faker

        for ($i = 0; $i < 50; $i++) { // สร้างข้อมูล 50 แถว
            Movie::create([
                'title' => $faker->sentence(3), // สร้างชื่อภาพยนตร์
                'release_year' => $faker->year(), // สร้างปีที่ออกฉาย
                'genre' => $faker->word(), // สร้างประเภทภาพยนตร์
                'description' => $faker->paragraph(), // สร้างคำอธิบายภาพยนตร์
            ]);
        }
    }
}

