<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Carbon\Carbon;
use App\Models\Book;


class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {



        Book::create([

            'full_name' => 'Nermen',

            'phone' => '1234567889',

            'email' => 'nermen@gmail.com',

            'check_in_date' => Carbon::parse('2023-09-01'),

            'check_out_date' => Carbon::parse('2023-09-06'),

            'room_type'      => 'Delux' ,

            'guests_number'  =>  4 ,

            'content'   => 'xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx' ,

        ]);
    }
}
