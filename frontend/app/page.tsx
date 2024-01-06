import React from 'react'
// Panggil Function ViewPage
import ViewPage from './view/page'

export default function MainPage() {
  return (
  <div>
    {/* ViewPage */}
    <h1>Formulir Pendaftaran SMA</h1>
      
        <div 
        >
          <label>Nama:</label>
          <input
            type="text"
            name="nama"

          />
        </div>
        <div>
          <label>Email:</label>
          <input
            type="email"
            name="email"
          />
        </div>
        <div>
          <label>Alamat:</label>
          <textarea
            name="alamat"
          ></textarea>
        </div>
        <div>
          <label>No. HP:</label>
          <input
            type="text"
            name="noHp"
          />
        </div>
        <div>
          <label>Sekolah Asal:</label>
          <input
            type="text"
            name="sekolahAsal"
          />
        </div>
        <button type="submit">Daftar</button>
      

  </div>
  )
}
