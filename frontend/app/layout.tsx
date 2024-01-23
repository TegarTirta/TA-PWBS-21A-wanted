import type { Metadata } from 'next'
// import { Inter } from 'next/font/google'
// import './styles/globals.css'

// panggill file "style.module.css"
import style from "./styles/style.module.css"

// panggil style tailwind
import "tailwindcss/tailwind.css";

// const inter = Inter({ subsets: ['latin'] })

export const metadata: Metadata = {
  title: 'View Data Mahasiswa',
}

export default function MainLayout({
  children,
}: {
  children: React.ReactNode
}) {
  return (
    <html lang="en">
      <head>
        {/* tambahkan favicon */}
      <link rel="shortcut icon" href="./images/favicon.ico" type="image/x-icon" />
      {/* tambahkan cdn fontawesome */}
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"/>
      </head>

    
      <body className={style.layout}>
      <header className={style.header}>
        <img src="./images/logo.png" alt="Logo" />
      </header>
      
      <div className={`${style.content} ${style.content_bg}`}>
      
        {children}
      
      </div>
        

    <div className={style.footer}>      
      <footer>&copy; 2023 | PWBS - TI 21 A</footer>
    </div>
        </body>


    </html>
  )
}
