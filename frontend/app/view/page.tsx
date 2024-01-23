/* eslint-disable @next/next/no-async-client-component */
"use client";

import React, { useState } from 'react'
import Link from 'next/link'
import useSWR from 'swr';
import {Md5} from 'ts-md5';
import { Result } from 'postcss';

// buat fungsi untuk fetch data
// async function getData()
// {
//   // buat variabel untuk link ke url server (get data Mahasiswa)
//   const response = await fetch(`${process.env.APIMahasiswa}/get`, {cache:'no-store'});

//   // return variabel response
//   return response.json();

// }

// buat fungsi untuk fetch data
const fetchData = (url : string) => 
  fetch(url)
  .then((response) => response.json())


export default function ViewPage() {

  // buat state awal
  const[search, setSearch] = useState("");

  // buat arrow function untuk tombol cari data
  // const btnSearch = (e:any) => {
  //   e.preventDefault();
  //   location.href = "https://google.com";
  // }

  // panggil fungsi get data
  // const data = await getData();

  // buat fungsi untuk pencarian
  const searchData = (e:any) => {
    e.preventDefault();

    // isi nilai result dari text cari yang diisi
    const result = e.target[0].value;
    // isi nilai state "setSearch"
    setSearch(result);
  }

  // buat variabel object
  const {data, mutate} = useSWR(
    search == "" ?
    `${process.env.APIMahasiswa}/get`:
    `${process.env.APIMahasiswa}/search/${search}`,
    fetchData);

    // buat fungsi untuk hapus data
    const setDelete = (npm:string,nama:string)=>{
      // alert(`Data Mahasiswa : ${nama} ingin di hapus ?`);

      // konfirmasi hapus data
      // jika tombol "ok" di pilih
      if(confirm(`Data Mahasiswa : ${nama} ingin di hapus ?`) == true)
      {
        // alert("Tombol OK")
        // alert(btoa(npm));
      //  alert (Md5.hashStr(npm))
      // alert(btoa(Md5.hashStr(npm)))

      // buat variabel untuk hash "npm"
      let npm_hash = (btoa(Md5.hashStr(npm)));
      // ambil service "delete" dari service
      fetch(`${process.env.APIMahasiswa}/delete/${npm_hash}`, {
        method:"DELETE"
      })
      // response (format json)
      .then((response) => response.json())
      // result (hasil dari "response")
      .then((result)=>{alert(result.message); 
                      // refresh data
                      mutate(data);
                      })
      // jika proses "fetch" bermasalah
      .catch(() => console.error("Data gagal di kirim"));
      }
      // jika tombol "cencel" di pilih
      // else
      // {
      //   alert("Tombol Cencel")
      // }
    }
  
  return (
    <div>
      {/* area menu */}
      <nav className='flex justify-end mb-5'>
        <Link href={"/add"} className='mr-2 bg-slate-400 border-2 border-black px-5 py-2.5 w-35 rounded-full text-white active:bg-sky-500 text-center'>Tambah Data</Link>
        <a href={"/"} className='ml-2 bg-slate-400 border-2 border-black px-5 py-2.5 w-35 rounded-full text-white  active:bg-sky-500 text-center'>Refresh Data</a>
      </nav>

      {/* Area pencarian data */}
      <form action="" onSubmit={searchData}>
        <section className='mb-5'>
        <input type="text" name="" id="" placeholder="Cari data Mahasiswa" className='mr-4 border-2 border-black
         px-3 py-1 w-2/6 rounded-lg outline-none focus:border-sky-500' onChange={e => {setSearch(e.target.value)}}/>

        <button className='ml-2 bg-slate-400 border-2 border-black px-3 w-30 rounded-lg text-white  active:bg-sky-500' >Cari Data</button>

        </section>
        </form>
        {!data &&
        <section>
        <section className='text-center text-rose-700 mt-5 flex justify-center'>
          <img src="./images/loading.gif" alt="Loading icon" />
        </section>

        <section className='text-center text-black mt-5 flex justify-center'>
          Mohon Tunggu
        </section>
        </section>
        }
      {/* Area isi data */}
        <table className='w-full'>

          {/* Judul Tabel */}
        <thead>
          <tr>
            
          <th className='w-1/6 border-2 border-black bg-gray-200 text-center h-10'>Nomor Induk Siswa</th>
            <th className='w-auto border-2 border-black bg-gray-200 text-center h-10'>Nama</th>
            <th className='w-2/12 border-2 border-black bg-gray-200 text-center h-10'>Tingkatan Sekolah</th>
            <th className='w-1/5 border-2 border-black bg-gray-200 text-center h-10'>Telepone</th>
            <th className='w-2/12 border-2 border-black bg-gray-200 text-center h-10'>Aksi</th>
          </tr>
        </thead>

        {/* isi tabel */}
        <tbody>
          
          {/* tampilkan data mahasiswa dari service getData dalam format object*/}

          {
            // jika data tidak ditemukan
           data&&data.mahasiswa.length ==0 ?
          //  kondisi ketika data tidak di temukan
            <tr>
            <td colSpan={5} className='border-2 border-black bg-white text-center h-8'>Data Tidak Ditemukan !</td>
            </tr>
        :
        // isi nilai data dan lakukan pengambilan data
           data && data.mahasiswa.map((item:any) => 


          <tr key={item.id_mahasiswa}>  
            <td className='border-2 border-black bg-white text-center h-8'>{item.npm_mahasiswa}</td>
            <td className='border-2 border-black bg-white text-justify h-8'>{item.nama_mahasiswa}</td>
            <td className='border-2 border-black bg-white text-justify h-8'>{item.jurusan_mahasiswa}</td>
            <td className='border-2 border-black bg-white text-center h-8 '>{item.telepone_mahasiswa}</td>
            <td className='border-2 border-black bg-white text-black h-8 text-center p-2'>
              <button className='bg-sky-700 text-white px-3 py-2 rounded-lg mr-2'>
              <i className="fa-solid fa-pencil"></i>
              </button>
              <button className='bg-rose-700 text-white px-3 py-2 rounded-lg ml-2 'onClick={e=>setDelete(item.npm_mahasiswa,item.nama_mahasiswa)}>
              <i className="fa-solid fa-trash-arrow-up"></i>
              </button>
            </td>
          </tr>

        )
     }

        </tbody>

        </table>
      
    </div>
  )
}
