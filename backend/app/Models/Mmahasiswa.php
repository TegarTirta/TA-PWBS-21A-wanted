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
            ->select(
                "ID AS id_mahasiswa",
                "NPM AS npm_mahasiswa",
                "NAMA AS nama_jurusan",
                "TELEPON AS telpon_mahasiswa",
                "JURUSAN AS jurusan_mahasiswa"
            )
            ->orderBy("ID")
            ->get();
        //mengirim hasil variabel "query" ke controller "mahasiswa"
        return $query;
    }

    //buat fungsi pencarian data
    function searchData($keyword)
    {
        //tampilkan data dari "tb_mahasiswa"
        $query = DB::table('tb_mahasiswa')
            ->select(
                "ID AS id_mahasiswa",
                "NPM AS npm_mahasiswa",
                "NAMA AS nama_mahasiswa",
                "TELEPON AS telpon_mahasiswa",
                "JURUSAN AS jurusan_mahasiswa"
            )
            ->where("NPM", "$keyword")
            // ->orWhere("nama","LIKE","%$keyword%")
            // ->orWhereRaw("REPLACE(nama,' ','') LIKE REPLACE('%$keyword%',' ','')")
            ->orWhere(DB::raw("REPLACE(NAMA,' ','')"), "LIKE", DB::raw("REPLACE('%$keyword%',' ','')"))
            ->orWhere("TELEPON", "$keyword")
            ->orWhere("JURUSAN", "LIKE", "%$keyword%")
            ->orderBy("ID")
            ->get();
        //mengirim hasil variabel "query" ke controller "mahasiswa"
        return $query;
    }

    //buat fungsi detail data
    function detailData($id)
    {
        //tampilkan data dari "tb_mahasiswa"
        $query = DB::table('tb_mahasiswa')
            ->select(
                "ID AS id_mahasiswa",
                "NPM AS npm_mahasiswa",
                "NAMA AS nama_mahasiswa",
                "TELEPON AS telpon_mahasiswa",
                "JURUSAN AS jurusan_mahasiswa"
            )
            // ->where(DB::raw("TO_BASE64(npm)"),"$id")
            ->where(DB::raw("TO_BASE64(MD5(NPM))"), "$id")

            ->get();
        //mengirim hasil variabel "query" ke controller "mahasiswa"
        return $query;
    }

    // Buat Funsi Untuk Hapus Data 
    function deleteData($id)
    {
        DB::table("tb_mahasiswa")
            ->where(DB::raw("TO_BASE64(MD5(NPM))"), "$id")
            ->delete();
    }

    // Buat Fungsi Untuk Save Data
    function saveData($NPM, $NAMA, $TELEPON, $JURUSAN)
    {
        //Ambil Data 
        // "NPM" = Nama Field 
        //"$NPM" = NAMA PARAMETER
        $result = [
            "NPM" => $NPM,
            "NAMA" => $NAMA,
            "JURUSAN" => $JURUSAN,
            "TELEPON" => $TELEPON,
        ];
        //Perintah Simpan Data 
        DB::tabel("tb_mahasiswa")
            ->insert($result);
    }

    function checkUpdateData($NPM, $id, )
    {
        //tampilkan data dari "tb_mahasiswa"
        $query = DB::table('tb_mahasiswa')
            ->select(
                "ID AS id_mahasiswa",
                "NPM AS npm_mahasiswa",
                "NAMA AS nama_mahasiswa",
                "TELEPON AS telpon_mahasiswa",
                "JURUSAN AS jurusan_mahasiswa"
            )

            // ->orWhere("nama","LIKE","%$keyword%")
            // ->orWhereRaw("REPLACE(nama,' ','') LIKE REPLACE('%$keyword%',' ','')")
            ->where(DB::raw("TO_BASE64(MD5(NPM))"), "!=", "$id")
            ->where("NPM", "$NPM")
            ->get();
        //mengirim hasil variabel "query" ke controller "mahasiswa"
        return $query;
    }
    // Fungsi Update Data 
    function updateData($NPM, $NAMA, $TELEPON, $JURUSAN, $id)
    {
        //Ambil Data 
        //"NPM" = Nama Field 
        //"$NPM" = NAMA PARAMETER
        $result = [
            "NPM" => $NPM,
            "NAMA" => $NAMA,
            "JURUSAN" => $JURUSAN,
            "TELEPON" => $TELEPON,
        ];

        DB::table("tb_mahasiswa")
        ->where(DB::raw("TO_BASE64(MD5(NPM))"), "$id")
        ->update($result);

    }

}
