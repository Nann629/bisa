<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Sub;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class SubsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Schema::disableForeignKeyConstraints();
        Sub::truncate();
        Schema::enableForeignKeyConstraints();

        $data = [
            ['name' => '1.1'],
        ];

        foreach ($data as $value) {
            # code...
            Sub::insert([
                'name' => $value['name'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

        // DB::table('subs')->insert([
        //     'deskripsi' => '1.1',
        // ]);
    }
}
