<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mmahasiswa;
use Illuminate\Support\Facedes\Mail;


class Mahasiswa extends Controller
{
    //buat variabel
    protected $model;

    //buat fungsi global
    function __construct()
    {
        //inisialisasi variabel "model" dari model "Mmahasiswa"
        $this->model = new Mmahasiswa();
    }

    function getController()
    {
        //isi nilai dari variabel "result" dari fungsi "getData" dari model "Mmahasiswa"
        $result = $this->model->getData();

        //Kembalikan nilai variabel "result" ke dalam object "mahasiswa"
        return response(["mahasiswa"=> $result], http_response_code());
    }
    // buat sungsi untuk pencarian data
    function searchController($keyword)
    {
        //isi nilai dari variabel "searchData" dari fungsi "getData" dari model "keyword"
        $result = $this->model->searchData($keyword);
        
        //Kembalikan nilai variabel "result" ke dalam object "mahasiswa"
        return response(["mahasiswa"=> $result], http_response_code());
    }
    // buat fungsi detail data
    function detailController($id)
    {
         //isi nilai dari variabel "detailhData" dari fungsi "detailData" dari model "Mmahasiswa" sesuai dengan isi parameter "id"
        $result = $this->model->detailData($id);
        //Kembalikan nilai variabel "result" ke dalam object "mahasiswa"
        return response(["mahasiswa"=> $result], http_response_code());
    }
    // buat fungsi untuk hapus data
    function deleteController($id)
    {
        // apakah npm tersedia/tidak
        // jika data tersedia
        if(count($this->model->detailData($id)) == 1)
        {
            // lakukan penghapusan data 
            // (panggil fungsi "deleteData" dari Mmahasiswa)
            $this->model->deleteData($id);
            // buat status dan pesan 
            $status = 1;
            $message = "Data Berhasil Dihapus";     
         }
        // jika data tidak tersedia
        else
        {
             // buat status dan pesan 
            $status = 0;
            $message = "Data Gagal Dihapus ! (NPM Tidak Ditemukan)";
        }   
        // kembalikan nilai variabel "result" kedalam object "mahasiswa"
    return response(["status"=> $result, "message" => $message], http_response_code());
    }
    // buat fungsi untuk simpan data
    function saveController(Request $req)
    {
        // ambil data input
        // "npm" = variabel array yang menampung nilai dari $req
        //  "$req->npm" = variabel yang dikirim dari front end
        $data = [
            "npm" => $req->npm,
            "nama" => $req->nama,
            "telepone" => $req->telepone,
            "jurusan" => $req->jurusan,
            // "id" => base64_encode(md5($req->npm))
        ];
        $id = base64_encode(md5($req->npm));
        // lakukan pengecekan apakah data "npm" yang diisi sudah pernah tersimpan/belum di database
        
        // jika detail data tersedia
        if(count($this->model->detailData($id)) == 1)
        {
            // buat status dan pesan
            $status = 0;
            $message = "Data Gagal Disimpan ! (NPM Sudah Ada !)";
        }
        // jika data tersedia
        else
        {
            // lakukan penyimpanan data
            // (panggil fungsi "saveData" dari Mmahasiswa)
            $this->model->saveData($data["npm"],$data["nama"],$data["telepone"],$data["jurusan"]);
            // buat status dan pesan
            $status = 1;
            $message = "Data Berhasil Disimpan !";
        }
        // kembalikan nilai variabel "result" kedalam object "mahasiswa"
    return response(["status"=> $status, "message" => $message], http_response_code());
    }
    // buat fungsi untuk ubah data
    function updateController(Request $req ,$id)
    {
        // ambil data input
        $data = [
            "npm" => $req->npm,
            "nama" => $req->nama,
            "telepone" => $req->telepone,
            "jurusan" => $req->jurusan
        ];        
        // lakukan pengecekan apakah data "npm" yang diisi sudah pernah tersimpan/belum di database
        
        // jika data tersedia
        if(count($this->model->checkUpdateData($data["npm"], $id)) == 0)
        {
            // lakukan perubahan data
            // panggil model fungsi updateData dari model "Mmahasiswa"
            $this->model->updateData($data["npm"],$data["nama"],$data["telepone"],$data["jurusan"],$id);
            $status = 1;
            $message = "Data Berhasil di Ubah";
        }
        // jika data tidak tersedia
        else
        {
            $status = 0;
            $message = "Data Gagal di Ubah (NPM Tidah di Temukan !)";
        }
        // kembalikan nilai variabel "result" kedalam object "mahasiswa"
    return response(["status"=> $status, "message" => $message], http_response_code());
    }
}
