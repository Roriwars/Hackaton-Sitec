<?php

use App\cve;
use Illuminate\Database\Seeder;

class CveTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $results = Http::get('https://cve.circl.lu/api/last');
        $arrayId = array();
        for($i=0;$i<30;$i++){
            array_push($arrayId,$results[$i]["vulnerable_product"]);
        }
        foreach($arrayId as $id){
            cve::create([
                'id'=>$id,
            ]);
        }
    }
}
