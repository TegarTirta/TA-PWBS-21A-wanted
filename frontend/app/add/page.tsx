"use client";

import axios from 'axios';
import React, { useState } from 'react'


export default function AddPage() {

  // buat state untuk data input
  const[inputs, setInputs] = useState({
    // penamaan objek sesuaikan dengan "id" komponen
    txt_npm : "",
    txt_nama : "",
    txt_telepone : "",
    cbo_jurusan : ""
  })

  // buat arrow function untuk menampung data
  const getDataInput = (e: any) => {
    // buat variabel untuk nilai "id" dan "value" masing-masing komponen
    const id = e.target.id;
    const value = e.target.value;
    // panggil state "setinputs"
    setInputs((cmp : any) => {
      cmp[id] = value;

      console.log(cmp);
      return cmp;
    })
  }
  // buat arrow function untuk "setPost"
  const setPost = () => {
    // jika ada salah satu komponen tidak di isi
    if(inputs.txt_npm == "" || inputs.txt_nama == "" || inputs.txt_telepone == "" || inputs.cbo_jurusan == "" ){
      alert("Seluruh Data Wajib di Isi !")
    }
    // jika semua komponen di isi
    else
    {
      // alert("Seluruh Data Sudah di Isi.")
      // data kirim ke service "POST"
      axios.post(`${process.env.APIMahasiswa}/save`,{
        npm : inputs.txt_npm,
        nama : inputs.txt_nama,
        telepone : inputs.txt_telepone,
        jurusan : inputs.cbo_jurusan
      }) 
      .then((response) => {
        alert(response.data.message)
      })
    }
  }
  // buat arrow function untuk "btn_refresh"
  const setRefresh = () => location.reload();
  return (
    <div>
      {/* area komponen */}
      <section className='flex items-center mb-3'>
        {/* area label */}
        <section className='w-1/4'>
          <label htmlFor="txt_npm">NPM</label>
        </section>
        {/* area input */}
        <section className='w-3/4'>
          <input type="text" name="" id="txt_npm" className='w-1/2 border-2 border-black
         px-3 py-1 rounded-lg outline-none focus:border-sky-500' placeholder='Isi Data NPM' onChange={getDataInput}/>
        </section>
      </section>

      {/* area komponen */}
      <section className='flex items-center mb-3'>
        {/* area label */}
        <section className='w-1/4'>
          <label htmlFor="txt_nama">Nama Mahasiswa</label>
        </section>
        {/* area input */}
        <section className='w-3/4'>
          <input type="text" name="" id="txt_nama" className='w-1/2 border-2 border-black
         px-3 py-1 rounded-lg outline-none focus:border-sky-500' placeholder='Isi Data Nama Mahasiswa' onChange={getDataInput}/>
        </section>
      </section>

      {/* area komponen */}
      <section className='flex items-center mb-2'>
        {/* area label */}
        <section className='w-1/4'>
          <label htmlFor="txt_telepone">Telepone Mahasiswa</label>
        </section>
        {/* area input */}
        <section className='w-3/4'>
          <input type="text" name="" id="txt_telepone" className='w-1/2 border-2 border-black
         px-3 py-1 rounded-lg outline-none focus:border-sky-500' placeholder='Isi Nomor Telepone' onChange={getDataInput}/>
        </section>
      </section>

      {/* area komponen */}
      <section className='flex items-center mb-2'>
        {/* area label */}
        <section className='w-1/4'>
          <label htmlFor="cbo_jurusan">Jurusan Mahasiswa</label>
        </section>
        {/* area input */}
        <section className='w-3/4'>
          <select name="" id="cbo_jurusan" className='w-1/2 border-2 border-black
         px-3 py-1 rounded-lg outline-none focus:border-sky-500 bg-white' onChange={getDataInput}>
            <option value="">Pilih Jurusan Mahasiswa</option>
            <option value="Teknologi Informasi">Teknologi Informasi</option>
            <option value="Informatika">Informatika</option>
            <option value="Teknik Komputer">Teknik Komputer</option>
          </select>
        </section>
      </section>

       {/* area komponen */}
       <section className='flex items-center'>
        {/* area label */}
        <section className='w-1/4'>
          
        </section>
        {/* area button */}
        <section className='w-3/4'>
          <button id='btn_simpan' className='mr-2 bg-slate-400 border-2 border-black px-10  py-2.5 w-35 rounded-full text-white active:bg-sky-500 text-center' onClick={setPost}>
            Simpan
          </button>
          <button id='btn_refresh' className='ml-2 bg-rose-400 border-2 border-black px-10 py-2.5 w-35 rounded-full text-white  active:bg-sky-500 text-center' onClick={setRefresh}>
            Refresh
          </button>
          {/* <a href={"/add"} className='ml-2 bg-rose-400 border-2 border-black px-10 py-2.5 w-35 rounded-full text-white  active:bg-sky-500 text-center'>
            Refresh
          </a> */}
        </section>
      </section>
    </div>
  )
}
