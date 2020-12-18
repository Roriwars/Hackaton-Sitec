<?php

namespace App\Http\Controllers;

use DB;
use App\vendor;
use App\product;
use App\cve;
use App\version;
use App\versionByCve;
use App\solution;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class DataBaseController extends Controller
{
    public function getProduct(){
        return product::all();
    }
    public function getVendor(){
        return vendor::all();
    }
    public function getVersion(){
        return version::all();
    }

    public function init()
    {
        $results = Http::get('https://cve.circl.lu/api/last');
        for($i=0;$i<30;$i++){
            $listVulnerableProduct = array();
            $listVendor = array();
            $listCve = array();
            $listProduct = array();
            $listCveId=array();
            $listVersion=array();

            $cveId=$results[$i]["id"];
            $cveDescription=$results[$i]["summary"];                   
            cve::firstOrCreate([
                'id'=>$cveId,
                'description'=>$cveDescription,
            ]);

            $listVulnerableProduct=$results[$i]["vulnerable_product"];
            if(count($listVulnerableProduct)!=0){
                for($j=0;$j<count($listVulnerableProduct);$j++){
                    if(!in_array(explode(":",$listVulnerableProduct[$j])[3], $listVendor, true)){
                        array_push($listVendor,explode(":",$listVulnerableProduct[$j])[3]);
                        $newVendor=explode(":",$listVulnerableProduct[$j])[3];
                        vendor::firstOrCreate([
                            'nom'=>$newVendor
                        ]);
                        $idVendor = DB::table('vendors')->where('nom',$listVendor[count($listVendor)-1])->first()->id;
                    }else{
                        $idVendor = DB::table('vendors')->where('nom',$listVendor[count($listVendor)-1])->first()->id;
                    }
                    if(!in_array(explode(":",$listVulnerableProduct[$j])[4], $listProduct, true)){
                        array_push($listProduct,explode(":",$listVulnerableProduct[$j])[4]);
                        $newProduct=explode(":",$listVulnerableProduct[$j])[4];
                        product::firstOrCreate([
                            'nom'=>$newProduct,
                            'idVendor'=>$idVendor
                        ]);
                        $idProduct = DB::table('products')->where('nom',$listProduct[count($listProduct)-1])->first()->id;
                    }else{
                        $idProduct = DB::table('products')->where('nom',$listProduct[count($listProduct)-1])->first()->id;
                    }
                    $newVersion=explode(":",$listVulnerableProduct[$j])[5];
                    version::firstOrCreate([
                        'version'=>$newVersion,
                        'idProduct'=>$idProduct
                    ]);
                    $versionId = DB::table('versions')->where('version',$newVersion)->where('idProduct',$idProduct)->first()->id;
                    
                    versionByCve::firstOrCreate([
                        'idCve'=>$cveId,
                        'idVersion'=>$versionId,
                    ]); 
                    
                }
            }
            if(array_key_exists("capec",$results[$i])){
                $listSolution=$results[$i]["capec"];
                if(count($listSolution)>0){
                    for($j=0;$j<count($listSolution);$j++){
                        solution::firstOrCreate([
                            'idCve'=>$cveId,
                            'nom'=>$listSolution[$j]['name'],
                            'prerequis'=>$listSolution[$j]['prerequisites'],
                            'solution'=>$listSolution[$j]['solutions'],
                            'description'=>$listSolution[$j]['summary'],
                        ]);
                    }
                }
            }
        }
    }

}