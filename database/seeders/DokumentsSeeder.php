<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Dokument;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class DokumentsSeeder extends Seeder
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
        Dokument::truncate();
        Schema::enableForeignKeyConstraints();

        $data = [
            ['image' => 'ada', 'kriterias_id' => 1, 'subs_id' => 1],
        ];

        foreach ($data as $value) {
            # code...
            Dokument::insert([
                'image' => $value['image'],
                'kriterias_id' => $value['kriterias_id'],
                'subs_id' => $value['subs_id'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }

        // DB::table('dokuments')->insert([
        //     'file' => 'ada',
        //     'kriterias_id' => '1',
        //     'subs_id' => '1',
        // ]);
    }
}
