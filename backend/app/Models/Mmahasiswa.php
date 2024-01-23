<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Mmahasiswa extends Model
{
    // use HasFactory;

    //buat fungsi untuk ambil data "tb_mahasiswa"
    function getData()
    {
        //tampilkan data dari "tb_mahasiswa"
        $query = DB::table('tb_mahasiswa')
                ->select("id AS id_mahasiswa","npm AS npm_mahasiswa","nama AS nama_mahasiswa","telepone AS telepone_mahasiswa",
                "jurusan AS jurusan_mahasiswa")
                ->orderBy("id")
                ->get();
        //mengirim hasil variabel "query" ke controller "mahasiswa"
        return $query;
    }
    // buat fungsi untuk pencarian data
    function searchData($keyword)
    {
         //tampilkan data dari "tb_mahasiswa"
         $query = DB::table('tb_mahasiswa')
         ->select("id AS id_mahasiswa","npm AS npm_mahasiswa","nama AS nama_mahasiswa","telepone AS telepone_mahasiswa",
         "jurusan AS jurusan_mahasiswa")
        ->where("npm","$keyword")
        //->orWhere("nama","LIKE","%$keyword%")
        ->orWhere(DB::raw("REPLACE(nama,' ','')"),"LIKE",DB::RAW("REPLACE('%$keyword%',' ','')"))
        //->orWhereRaw("REPLACE(nama,' ','') LIKE REPLACE('%$keyword%',' ','')")
        ->orWhere("telepone","$keyword")
        ->orWhere("jurusan","LIKE","%$keyword%")
         ->orderBy("id")
         ->get();
        //mengirim hasil variabel "query" ke controller "mahasiswa"
        return $query;
    }
    // buat fungsi detail data
    function detailData($id)
    {
         //tampilkan data dari "tb_mahasiswa"
         $query = DB::table('tb_mahasiswa')
         ->select("id AS id_mahasiswa","npm AS npm_mahasiswa","nama AS nama_mahasiswa","telepone AS telepone_mahasiswa",
         "jurusan AS jurusan_mahasiswa")
       // ->where(DB::RAW("TO_BASE64(npm)") ,"$id")
       ->where(DB::RAW("TO_BASE64(MD5(npm))") ,"$id")
         ->get();
        //mengirim hasil variabel "query" ke controller "mahasiswa"
        return $query;
    }
    // buat fungsi untuk hapus data
    function DeleteData()
    {
        // perintah untu hapus data
        DB::table("tb_mahasiswa")
        ->where(DB::RAW("TO_BASE64(MD5(npm))") ,"$id")
        ->delete();
    }
    // buat fungsi untuk simpan data
    function saveData($npm,$nama,$telepone,$jurusan)
    {
        // ambil data
        // "npm" = nama field
        // "$npm" = nama parameter
        $result = [
            "npm" => $npm,
            "nama" => $nama,
            "telepone" => $telepone,
            "jurusan" => $jurusan
        ];
        // perintah simpan data
        DB::table("tb_mahasiswa")
        ->insert($result);
        
    }
    function checkUpdateData($npm,$id)
    {
        //tampilkan data dari "tb_mahasiswa"
        $query = DB::table('tb_mahasiswa')
        ->select("id AS id_mahasiswa","npm AS npm_mahasiswa","nama AS nama_mahasiswa","telepone AS telepone_mahasiswa",
        "jurusan AS jurusan_mahasiswa")
      // ->where(DB::RAW("TO_BASE64(npm)") ,"$id")
      ->where(DB::RAW("TO_BASE64(MD5(npm))") ,"!=","$id")
      -> where("npm","$npm")
        ->get();
       //mengirim hasil variabel "query" ke controller "mahasiswa"
       return $query;
    }
    // fungsi untuk ubah data
    function updateData($npm, $nama, $telepone, $jurusan, $id)
    {
        // ambil data
        // "npm" = nama field
        // "$npm" = nama parameter
        $result = [
            "npm" => $npm,
            "nama" => $nama,
            "telepone" => $telepone,
            "jurusan" => $jurusan
        ];
        // perintah untu ubah data
        DB::table("tb_mahasiswa")
        ->where(DB::RAW("TO_BASE64(MD5(npm))") ,"$id")
        ->update($result);
    }
}
