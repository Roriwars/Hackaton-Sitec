<?php

namespace App\Http\Controllers;

use App\product_client;
use DB;
use Illuminate\Http\Request;

class ProductsClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return product_client::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        product_client::create($request->all());
    }

    public function show($productClient)
    {
        $listProductAndCve = array();
        $listVersions =array();
        $listProducts =array();
        $listVendors =array();
        $products_client=DB::table('product_clients')->where('idClient',$productClient)->get();
        foreach($products_client as $product_client){
            $versions=DB::table('versions')->where('id',$product_client->idVersion)->get();
            foreach($versions as $version){
                $cvesV=DB::table('version_by_cves')->where('idVersion',$version->id)->get();
                foreach($cvesV as $cveV){
                    $cves=DB::table('cves')->where('id',$cveV->idCve)->get();
                    foreach($cves as $cve){
                        $solutions=DB::table('solutions')->where('idCve',$cve->id)->get();
                        $cve->solutions=$solutions;
                    }
                }
                $version->cves=$cves;
                array_push($listVersions,$version);
                $products=DB::table('products')->where('id',$version->idProduct)->get();
                foreach($products as $product){
                    $product->versions=array($version);
                    $ajout=true;
                    foreach($listProducts as $Product){
                        if($Product->id==$product->id){
                            array_push($Product->versions,$product->versions[0]);
                            $ajout=false;
                            break;
                        }
                    }
                    if($ajout){
                        array_push($listProducts,$product);
                    }
                }
            }
        }
        foreach($listProducts as $product){
            $vendors=DB::table('vendors')->where('id',$product->id)->get();
            foreach($vendors as $vendor){
                $vendor->products=array($product);
                $ajout=true;
                foreach($listVendors as $Vendor){
                    if($Vendor->id==$vendor->id){
                        $ajout=false;
                        array_push($Vendor->products,$vendor->products[0]);
                        break;
                    }
                }
                if($ajout){
                    array_push($listVendors,$vendor);
                }
            }
        }
        return $listVendors;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, product_client $product_client)
    {
        $product_client->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(product_client $product_client)
    {
        $product_client->delete();
    }
}