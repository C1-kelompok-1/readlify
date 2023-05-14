# Readify
Readify merupakan paltform membaca novel gratis dan berbayar yang dapat digunakan oleh semua orang baik hanya membaca maupun menulis novel, dan juga menjual setiap episode novel yang dibuat.

## Spesifikasi
1. PHP 8.0^
2. MySQL 5.4^
3. Pastikan ekstensi GD milik PHP sudah terinstall.

## Tutorial pengunaan Readify
Berikut adalah Tutorial penggunaan web Readify:

#### 1. Register
<p>Pengguna bisa melakukan register atau pembuatan akun dengan mengisi email, username, dan password.</p>
<img src="https://github.com/C1-kelompok-1/readlify/assets/120198104/f02d387a-8c90-47a1-b538-99b06eab6f37" />

#### 2. Login
<p>Disini pengguna hanya perlu memasukkan email atau username serta password untuk melakukan login.</p>
<img src="https://github.com/C1-kelompok-1/readlify/assets/120198104/df773116-1636-40f6-aebf-4dc7346061f5" />

#### 3. Halaman Pembaca
##### a. Beranda
<p>Halaman beranda pada Pembaca berisi input pencarian yang dapat digunakan untuk mencari novel berdasarkan judul, juga terdapat beberapa section yang ada di halaman beranda.</p>
<img src="https://github.com/C1-kelompok-1/readlify/assets/120198104/8d512948-24ea-4482-b971-4bbe264efe63" />

##### b. Genre
<p>Halaman genre dapat digunakan untuk mencari novel berdasarkan genre yang dipilih.</p>
<img src="https://github.com/C1-kelompok-1/readlify/assets/120198104/5c92e8e9-635a-4058-b304-71aefcad88ea" />
<p>Kemudian ketika pembaca memilih novel sesuai genre yang dipilih maka akan muncul informasi seputar novel dan episode yang tersedia</p>
<img src="https://github.com/C1-kelompok-1/readlify/assets/120198104/06bf5231-ad18-4464-8c5e-d2d78a586321" />

##### c. Beli Koin
<p>Pengguna dapat membeli paket koin di halaman ini untuk mengisi saldo koin mereka.</p>
<img src="https://i.postimg.cc/RhYY4QzK/Screenshot-2023-05-10-212253.png)](https://postimg.cc/5Qwgmzy2" />
<img src="https://i.postimg.cc/Y00P5DTt/Screenshot-2023-05-10-212301.png)](https://postimg.cc/H8G35zpN" />

#### 4. Halaman Penulis
##### a. Halaman Utama Pada Penulis
<p>Halam penulis hampir sama sengan halaman pembaca, namun yang membedakan adalah pada halaman penulis terdapat menu novel saya untuk membuat novel sedangkan pada pembaca tidak ada.</p>
<img src="https://github.com/C1-kelompok-1/readlify/assets/120198104/25913a0f-d240-49d6-b248-24b9512100a2" />

##### b. Buat Novel
<p>Di halaman "Novel saya" penulis dapat menulis novelnya.</p>
<img src="https://i.postimg.cc/dVrfcyNZ/Screenshot-2023-05-10-212114.png)](https://postimg.cc/PCfymPjd" />

<p>Buat novel dengan mengisi foto sampul, judul novel, deskripsi, dan beberapa genre yang sesuai.</p>
<img src="https://i.postimg.cc/KzJVshq9/Screenshot-2023-05-10-212133.png)](https://postimg.cc/7GJmfdy7" />

<p>Di halaman detail novel terdapat beberapa informasi terkait suatu novel seperti jumlah episode, jumlah disukai, genre, deskripsi, dan episode-episode novel tersebut.</p>
<img src="https://i.postimg.cc/yYJ5n5FP/Screenshot-2023-05-10-212144.png)](https://postimg.cc/1fQJ3v7n" />

<p>Di halaman ini pengguna dapat membaca setiap episode novel yang tersedia. Pengguna juga dapat membeli episode yang berbayar jika saldo koin penggua tersebut mencukupi.</p>
<img src="https://i.postimg.cc/66bgrwGq/Screenshot-2023-05-10-212233.png)](https://postimg.cc/QV5fD2mZ" />
<img src="https://i.postimg.cc/cCW6xjQG/Screenshot-2023-05-10-214244.png)](https://postimg.cc/2bHCT0c0" />

#### 5. Ganti profil
[![Screenshot-2023-05-10-212313.png](https://i.postimg.cc/LX6QP09j/Screenshot-2023-05-10-212313.png)](https://postimg.cc/hJ60Ws7G)
<p>Pengguna dapat mengganti informasi terkait akun mereka di halaman profil.</p>

### 6. Halaman admin
#### Dashboard
<p>Halaman dashboard berisi informasi singkat berupa jumlah novel, jumlah penulis, jumlah pembaca, dan jumlah total pendapatan dari pembelian koin.</p>


#### Daftar pengguna
[![Screenshot-2023-05-11-111517.png](https://i.postimg.cc/dtxvw5yS/Screenshot-2023-05-11-111517.png)](https://postimg.cc/vcfCvLXW)
<p>Daftar pengguna dapat dilihat di halaman ini, pengguna disini merupakan pengguna dengan role penulis maupun pembaca. Disini admin juga dapat mengangkat pengguna sebagai seorang penulis dengan menekan tombol Jadikan Penulis.</p>

#### Daftar novel
[![Screenshot-2023-05-10-213516.png](https://i.postimg.cc/BnyPGjyD/Screenshot-2023-05-10-213516.png)](https://postimg.cc/qNsvsvpM)
<p>Novel yang ada dapat dilihat pada halaman daftar novel.</p>

#### Genre
[![Screenshot-2023-05-10-213523.png](https://i.postimg.cc/rFftQnNf/Screenshot-2023-05-10-213523.png)](https://postimg.cc/gn6J0K5h)
<p>Data master genre dapat diatur di halaman ini.</p>

#### Paket koin
[![Screenshot-2023-05-10-213529.png](https://i.postimg.cc/gcqh6kXF/Screenshot-2023-05-10-213529.png)](https://postimg.cc/hhvvkn1p)
<p>Data master paket koin dapat diatur di halaman ini.</p>

## ERD
[![readify-1.png](https://i.postimg.cc/7ZCw08r4/readify-1.png)](https://postimg.cc/Xr0R6Pv1)
<p>File SQL-nya dapat diunduh <a href="https://drive.google.com/drive/folders/1ml8GR9rZriynJIHetj5aBOM-4-yt4gKb?usp=share_link">disini</a>.</p>

## Anggota
1. Muhammad Novil Fahlevy (2109116095)
2. Karlen Syaputra (2109116086)
3. Marliani Rura (2109116096)

## Kredit
1. [PodTalk – Free Bootstrap 5 HTML5 Website Template](https://themewagon.com/themes/podtalk-free-bootstrap-5-html5-website-template)
2. [Dashtreme – Free Bootstrap 4 HTML5 Admin Dashboard Template](https://themewagon.com/themes/free-bootstrap-4-html5-admin-dashboard-template-dashtreme)
