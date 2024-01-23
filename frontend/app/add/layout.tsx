import React from 'react'
import type { Metadata } from 'next'
import AddPage from './page'


export const metadata: Metadata = {
    title: 'Tambah Data Siswa',
  }

export default function AddLayout() {
  return (
    <div>
        {/* panggil file "page" (folder "add") */}
        <AddPage></AddPage>
    </div>
  )
}
