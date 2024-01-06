import type { Metadata } from "next";
//import { Inter } from 'next/font/google'
// import './styles/globals.css'

// Panggil File "style.module.css"
import style from "./styles/style.module.css";

//const inter = Inter({ subsets: ['latin'] })

export const metadata: Metadata = {
  title:"Pendaftaran Siswa Baru",
};

export default function MainLayout({
  children,
}: {
  children: React.ReactNode;
}) {
  return (
    <html lang="en">
      <head>
        {/* Tambahkan Favicon */}
        <link
          rel="shortcut icon"
          href="./images/imot.png"
          type="image/x-icon"
        />
      </head>

      <body className={style.layout}>
        <header className={style.header}>
          <img src="./images/logo.png" alt="Logo" />
        </header>
        <section className={`${style.content} ${style.content_bg}`}>{children}</section>

        <footer className={style.footer}>&copy; 2023 | PWBL - TI 20 A</footer>
      </body>
    </html>
    
  );
}
