<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function getCveByVendor($nomVendor){
        $vendors=DB::table('vendors')->where('nom',$nomVendor)->get();

        $listProducts =array();
        $listVersions =array();
        foreach($vendors as $vendor){
            $products=DB::table('products')->where('idVendor',$vendor->id)->get();
            foreach($products as $product){
                $versions=DB::table('versions')->where('idProduct',$product->id)->get();
                foreach($versions as $version){
                    $cvesV=DB::table('version_by_cves')->where('idVersion',$version->id)->get();
                    foreach($cvesV as $cveV){
                        $cves=DB::table('cves')->where('id',$cveV->idCve)->get();
                        foreach($cves as $cve){
                            $solutions=DB::table('solutions')->where('idCve',$cve->id)->get();
                            $cve->solutions=$solutions;
                        }
                    }
                    $version->cve=$cve;
                    array_push($listVersions, $version);
                }
                $product->versions=$listVersions;
                array_push($listProducts, $product);
            }
            $vendor->products=$listProducts;
        }

        return $vendors;
    }

    public function getCveByProduct($nomProduct){
        $listVersions =array();
        $products=DB::table('products')->where('nom',$nomProduct)->get();
        foreach($products as $product){
            $versions=DB::table('versions')->where('idProduct',$product->id)->get();
            foreach($versions as $version){
                $cvesV=DB::table('version_by_cves')->where('idVersion',$version->id)->get();
                foreach($cvesV as $cveV){
                    $cves=DB::table('cves')->where('id',$cveV->idCve)->get();
                    foreach($cves as $cve){
                        $solutions=DB::table('solutions')->where('idCve',$cve->id)->get();
                        $cve->solutions=$solutions;
                    }
                }
                $version->cve=$cve;
                array_push($listVersions, $version);
            }
            $product->versions=$listVersions;
        }

        return $products;
    }

    public function getCveWithVendorProductVersion($nomVendor,$nomProduct,$nomVersion){
        $vendors=DB::table('vendors')->where('nom',$nomVendor)->get();

        $listProducts =array();
        $listVersions =array();
        foreach($vendors as $vendor){
            $products=DB::table('products')->where('idVendor',$vendor->id)->where('nom',$nomProduct)->get();
            foreach($products as $product){
                $versions=DB::table('versions')->where('idProduct',$product->id)->where('version',$nomVersion)->get();
                foreach($versions as $version){
                    $cvesV=DB::table('version_by_cves')->where('idVersion',$version->id)->get();
                    foreach($cvesV as $cveV){
                        $cves=DB::table('cves')->where('id',$cveV->idCve)->get();
                        foreach($cves as $cve){
                            $solutions=DB::table('solutions')->where('idCve',$cve->id)->get();
                            $cve->solutions=$solutions;
                        }
                    }
                    $version->cve=$cve;
                    array_push($listVersions, $version);
                }
                $product->versions=$listVersions;
                array_push($listProducts, $product);
            }
            $vendor->products=$listProducts;
        }

        return $vendors;
    }

    public function getCveWithVendorProduct($nomVendor,$nomProduct){
        $vendors=DB::table('vendors')->where('nom',$nomVendor)->get();

        $listProducts =array();
        $listVersions =array();
        foreach($vendors as $vendor){
            $products=DB::table('products')->where('idVendor',$vendor->id)->where('nom',$nomProduct)->get();
            foreach($products as $product){
                $versions=DB::table('versions')->where('idProduct',$product->id)->get();
                foreach($versions as $version){
                    $cvesV=DB::table('version_by_cves')->where('idVersion',$version->id)->get();
                    foreach($cvesV as $cveV){
                        $cves=DB::table('cves')->where('id',$cveV->idCve)->get();
                        foreach($cves as $cve){
                            $solutions=DB::table('solutions')->where('idCve',$cve->id)->get();
                            $cve->solutions=$solutions;
                        }
                    }
                    $version->cve=$cve;
                    array_push($listVersions, $version);
                }
                $product->versions=$listVersions;
                array_push($listProducts, $product);
            }
            $vendor->products=$listProducts;
        }

        return $vendors;
    }
}
