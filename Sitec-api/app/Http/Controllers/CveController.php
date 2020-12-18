<?php

namespace App\Http\Controllers;

use App\cve;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cves=DB::table('cves')->get();
        foreach($cves as $cve){
            $solutions=DB::table('solutions')->where('idCve',$cve->id)->get();
            $cve->solutions=$solutions;
        }
        return $cves;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\cve  $cve
     * @return \Illuminate\Http\Response
     */
    public function show($cve)
    {
        $cves=DB::table('cves')->where('id',$cve)->get();
        foreach($cves as $cve){
            $solutions=DB::table('solutions')->where('idCve',$cve->id)->get();
            $cve->solutions=$solutions;
        }
        return $cves;
    }
}
