<?php

namespace App\Http\Controllers;

use App\Models\Patiens;
use Dflydev\DotAccessData\Data;
use Illuminate\Http\Request;

class PatiensController extends Controller
{
    function index(){
        // Mengambil data dari database
        $patiens = Patiens::all();
        // Melakukan validasi jika berhasil
        if($patiens->isNotEmpty()){
            $data = [
                "messege" => "Get All",
                "data" => $patiens
            ];
            // Mengembalikan data dengan format json
            return response()->json($data,200);
        }
        // Jika data tidak ada
        else{
            $data= [
                "messege" => "Data is empty",
            ];
            // Mengembalikan data dengan format json
            return response()->json($data,200);  
        }
       
    }
    
    function store(Request $request){
        // Elequent validasi
        $validateData = $request->validate([
            "name"=> "required",
            "phone"=>"required | numeric",
            "alamat"=>"required",
            "status"=>"required",
            "in_date_at"=>"required | date",
            "out_date_at"=>"nullable"
        ]);
        // Memasukan hasil validasi ke variable patiens
        $patiens = Patiens::create($validateData);
        // Mengembalikan data dengan format json
        return response() -> json($patiens,201);
        
    }

    function show($id){
        // mencari data pasien
         $patiens = Patiens::find($id);
        //  melakukan validasi
        if($patiens){
            $data = [
                "messege" =>  "Get Detail Pasien",
                "data" => $patiens
            ];
            // Mengembalikan data dengan format json
            return response()->json($data, 200);
        }
        // Jika data yang dicari tidak ada 
       else{
           $data = [ 
               "messege" => "Resource Not Found"
           ];
           // Mengembalikan data dengan format json
           return response()->json($data, 404);
       }
         
    }


    function update( Request $request, $id){
        // mencari id 
        $patiens = Patiens::find($id);
        // melakukan validasi
        if($patiens){
            // update data yang di pilih dari id
            $patiens -> update([
                "name"=>$request->name ?? $patiens->name,
                "phone"=>$request->phone ?? $patiens->phone,
                "alamat"=>$request->alamat ?? $patiens-> alamat,
                "status"=>$request->status ?? $patiens->status,
                "in_date_at"=>$request->in_date_at ?? $patiens-> in_date_at,
                "out_date_at"=>$request->out_date_at ?? $patiens->out_date_at
            ]);
            $data = [
                "messege" => "Resource is update succsessfully",
                "data" => $patiens
            ];
            // Mengembalikan data dengan format json
            return response() -> json($data,200);}
        //Jika data tidak ditemukan
        else{
            $data = [ 
                "status" => "data not found"
            ];
            // Mengembalikan data dengan format json
            return response() -> json($data,404);
        } 
    }

    function destroy($id){
        // Mencari data patiens
        $patiens = Patiens::find($id);
        if($patiens){
             // Mengapus data pasien yang dipilih melalu id
            $patiens -> delete();
            $data = [
                "messsege" => "Resource is delete successfully",
            ];
            // Mengembalikan data dengan format json
            return response() -> json($data,200);
        }
        // Jika id tidak tersedia
        else{
            $data = [ 
                "messege" => "Resource not found"
            ];
            // Mengembalikan data dengan format json
            return response() -> json($data,404);
        }
       
       
    }

    function search($name){
        // Mencari nama pasien yang cocok atau mirip dengan yang ditulis
        $result = Patiens::where("name" ,"like","%".$name."%")
        // mengakses database
        ->get();
        // jika data tidak kosong dan tersedia
        if( $result->isNotEmpty()){
            $data = [
                "messege" => "Get searched resource",
                "data" => $result
            ];
            // Mengembalikan data dengan format json
            return response() -> json($data,200);
        }
        // Jika data tidak tersedia
        else{
            $data = [
                "messege" => "Resource not found"
            ];
            // Mengembalikan data dengan format json
            return response() -> json($data,404);
        }
        
    }

    function positive(){
        // Mendapatkan data status yang positive
        $result = Patiens::where("status" ,"positive")
        // Mengakses database
        ->get();
        $data = [
            "messege" => "Get positive resource",
            "total" => count($result),
            "data" => $result
        ];
        // Mengembalikan data dengan format json
        return response() -> json($data,200);
    }

    function recover(){
        // Mendapatkan data status yang recorvery
        $result = Patiens::where("status" ,"recovery")
        // mengakses database
        ->get();
        $data = [
            "messege" => "Get recorvered resource",
            "total" => count($result),
            "data" => $result
        ];
          // Mengembalikan data dengan format json
        return response() -> json($data,200);
    }

    function dead(){
        // Mendapatkan data status yang dead
        $result = Patiens::where("status" ,"dead")
        // Mengakses database
        ->get();
        $data = [
            "messege" => "Get dead resource" ,
            "total" => count($result),
            "data" => $result
        ];
          // Mengembalikan data dengan format json
        return response() -> json($data,200);
    }



}
