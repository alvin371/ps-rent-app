<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ChanelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('chanels')->insert([
            [
                'nama_chanel' => 'Channel 1',
                'status' => 'N',
            ],
            [
                'nama_chanel' => 'Channel 2',
                'status' => 'N',
            ],
        ]);
    }
}
