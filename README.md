# Tugas 1 IF3110 Pengembangan Aplikasi Berbasis Web

## Deskripsi Singkat

<div align="center">
<img src="https://i.imgur.com/0NI6Mkf.png" alt=""/>
</div>


Anda mungkin sudah tahu mengenai pabrik coklat terbesar seantero dunia, Willy Wangky.
Akan tetapi, produsen terbaik tidak akan sukses tanpa konsumen dan distributor terbaik.
Sebab coklat dari Willy Wangky sangat disenangi konsumen, maka Willy Wangky membutuhkan distributor yang handal dalam menangani penjualan coklat.
Untungnya, Willy Wangky mengenal Jan.
Jan sudah sangat pengalaman dengan distribusi makanan dan minuman ringan.
Bahkan, Jan sudah memiliki usaha sendiri bernama Jan’s Cook.

Willy Wangky pun meminta Jan untuk memberikan saran bagaimana cara menjual coklat-coklat miliknya pada konsumen.
Apalagi di tengah pandemi seperti ini, beberapa toko penjualan sepi dikunjungi pengunjung.
Jan tanpa pikir panjang, memberikan saran mengenai penjualan daring menggunakan aplikasi berbasis web.
Willy Wangky sangat senang dengan hal ini, dan segera mengutus Jan untuk mencari programmer terbaik untuk pengembangannya.

Willy Wangky menginginkan web tersebut agar penggunanya dapat melakukan pendaftaran akun, login, logout, pencarian produk, mendapatkan penjelasan produk secara detail, pembelian produk dan dapat melihat riwayat pembelian produk, dan pekerjanya dapat dengan mudah menambahkan jenis coklat baru yang ingin dijual serta menambah ketersediaan coklat.

Jan telah membuat desain user interface dengan low fidelity.
Sekarang, dia merekrut kalian untuk membuat sebuah aplikasi web yang membantu penjualan coklat milik Willy Wangky.
Disebabkan Jan sangat percaya dengan kalian, maka web yang kalian kembangkan dapat kalian hias dengan sebaik mungkin.
Perlu diingat bahwa tata letak komponen harus mengikuti desain dari Jan.

## Tools

* Untuk frontend, gunakan Javascript, HTML dan CSS. Tidak boleh menggunakan library atau framework CSS atau JS (e.g. JQuery, lodash, atau Bootstrap). CSS sebisa mungkin ada di file yang berbeda dengan HTML (tidak inline styling).
* Untuk backend, wajib menggunakan PHP tanpa framework apapun. Harap diperhatikan, Anda harus mengimplementasikan fitur menggunakan HTTP method yang tepat.
* Gunakan MySQL untuk menyimpan data.

## Requerements

### Login Page

![](mockup/Login.png)

Halaman pertama yang ditampilkan jika pengguna belum login atau sudah logout adalah halaman Login.
Pengguna dapat melakukan login sebagai user atau superuser. Login hanya membandingkan email dan password saja. 
Tidak perlu tambahan proteksi apapun.

Identitas pengguna yang sudah login akan disimpan sebagai cookie dalam browser. Cookie menyimpan data pengguna dalam bentuk string dengan panjang tertentu. Untuk mengetahui pengguna mana yang sedang login, string tersebut dapat dilihat di basis data. Identitas tersebut tidak boleh disimpan sebagai parameter HTTP GET. Jika cookie ini tidak ada, maka pengguna dianggap belum login dan aplikasi akan selalu mengarahkan (redirect) pengguna ke halaman ini, meskipun pengguna membuka halaman yang lain. Masa berlaku cookie dibebaskan.

### Register Page

![](mockup/Register.png)

Pengguna dapat mendaftarkan akun baru jika belum login atau sudah logout.
Pada halaman ini, pengguna mendaftarkan diri dengan email dan username yang unik.
Pengguna tidak dapat mendaftar sebagai superuser, karena superuser ditambahkan secara manual pada basis data.
Pengecekan keunikan nilai field dilakukan menggunakan AJAX. Jika unik, border field akan berwarna hijau.
Jika tidak unik, akan muncul pesan error pada form.

Validasi lain yang dilakukan pada sisi klien pada halaman ini adalah:
* Email memiliki format email standar seperti “example@example.com”.
* Username hanya menerima kombinasi alphabet, angka, dan underscore.

Setelah semua nilai field sudah diisi dan valid, pengguna dapat mendaftarkan akun barunya.
Jika akun berhasil didaftarkan, pengguna langsung diarahkan ke halaman Dashboard.
Mekanisme cookie sama dengan halaman Login.

### Dashboard page

![](mockup/Dashboard.png)

Pada halaman Dashboard, pengguna disambut dengan username pengguna dan daftar coklat yang tersedia.
Coklat ditampilkan secara terurut sesuai dengan banyak coklat yang terjual, mulai dari yang paling banyak sampai yang paling sedikit.
Banyak coklat yang ditampilkan dibatasi hanya sampai 10 coklat dengan penjualan terbanyak.
Pengguna dapat melihat detail coklat dengan mengklik gambar atau nama coklat.
Header aplikasi web untuk user terdiri dari search bar, pilihan untuk melihat daftar transaksi, dan pilihan untuk logout, sedangkan untuk superuser terdiri dari search bar, pilihan untuk menambah jenis coklat, dan pilihan untuk logout. Search bar digunakan untuk mencari coklat berdasarkan nama. Hasil pencarian ditampilkan pada halaman Search Result. Jika pengguna memilih untuk logout, pengguna akan diarahkan ke halaman Login.

### Search Result page

![](mockup/Search.png)


Hasil pencarian dari search bar di halaman Dashboard akan ditampilkan pada halaman ini. Untuk setiap coklat, ditampilkan informasi nama, deskripsi, banyak coklat terjual, dan gambar coklat. Pengguna dapat melihat detail coklat dengan menekan bagian manapun pada section coklat tersebut.


Jika daftar coklat melebihi jumlah tertentu (jumlah didefinisikan sendiri), maka akan muncul pagination untuk melihat daftar coklat selebihnya. Ketika memilih page, pengguna tidak diarahkan ke halaman baru namun daftar coklat langsung berubah di halaman ini.

### Chocolate Detail page

![](mockup/Detail%20User.png)

Pada halaman Chocolate Detail, terdapat beberapa informasi mengenai coklat yang dipilih,
yaitu nama, gambar, banyak coklat terjual, deskripsi, harga, dan ketersediaan dari coklat tersebut.
Jika coklat dengan jenis tersebut masih tersedia, pengguna dapat memilih tombol “Buy Now” yang kemudian akan menampilkan banyak coklat yang dibeli,
alamat pengiriman, total harga, tombol “Cancel” dan tombol “Buy” sebagai berikut:

![](mockup/Buy.png)

Pengguna memilih jumlah pembelian coklat dan alamat pengiriman.
Perubahan total harga ditampilkan secara real-time sesuai dengan perubahan jumlah pembelian coklat.
Pengguna tidak dapat melakukan pembelian coklat melebihi banyak coklat yang tersedia.
(Asumsi saat proses pembelian coklat, ketersediaan coklat tidak berubah).
Pastikan setelah proses pembelian, ketersediaan coklat berubah sebanyak jumlah yang dibeli.
Jika pengguna login sebagai superuser, tombol “Buy Now” digantikan oleh tombol “Add Stock” yang jika ditekan akan menampilkan banyak coklat yang ingin ditambah, tombol “Cancel” dan tombol “Add” sebagai berikut :

![](mockup/Detail%20Admin.png)

![](mockup/Add%20Stock.png)

### Transaction History Page

![](mockup/History.png)

Pada halaman ini, ditampilkan daftar coklat yang telah dibeli.
Daftar diurutkan berdasarkan tanggal pembelian coklat. 
Untuk setiap transaksi, ditampilkan informasi nama, jumlah pembelian, total harga, waktu pembelian dan alamat pengiriman.
Pengguna dapat mengetahui detail coklat yang telah dibeli dengan menekan nama coklat yang akan mengarahkan pengguna ke halaman Chocolate Detail.

### Add New Chocolate Page

![](mockup/Add.png)

Halaman ini hanya bisa diakses oleh superuser melalui pilihan untuk menambah jenis coklat pada header web.
Pada halaman ini, superuser dapat menambah jenis coklat yang ada beserta detail dari coklat tersebut.
Detail dari coklat meliputi nama, gambar, deskripsi, harga, dan ketersediaan dari coklat tersebut.
Seluruh detail pada coklat harus diisi sebagai persyaratan coklat dapat ditambahkan.

## Keterangan Tambahan

* Jam pada aplikasi web mengacu pada jam lokal pengguna.
* Basis data didefinisikan sendiri.

## Bonus

Catatan: Kerjakan dahulu spesifikasi wajib sebelum mengerjakan bonus.

1. Data yang disimpan pada cookie memiliki expiry time. Jika access token ini tidak ada atau tidak valid, maka pengguna dianggap belum login. Expiry time sebuah access token berbeda dengan waktu berlaku cookie.
2. Pada halaman Buy Chocolate, ketersediaan coklat diperbaharui secara real-time. Contoh jika pengguna A ingin membeli persediaan terakhir coklat dengan jenis tersebut dan ternyata pengguna B telah membeli coklat terakhir tersebut, maka ketersediaan coklat perlu diperbaharui. Akibatnya, pengguna A tidak dapat membeli coklat dengan jenis tersebut. Pembaharuan ketersediaan coklat menggunakan AJAX.
3. Tampilan dibuat responsif (minimal untuk ukuran 1280x768 dan 800x600). Artinya, tampilan mungkin berubah menyesuaikan ukuran layar.

## Cara instalasi
1. Download PHP dan MySQL menggunakan XAMPP.
2. Lakukan instalasi pada file download XAMPP.
3. Pilih MySQL dan PHPMyAdmin sebagai modul tambahan yang perlu diinstalasi.
4. Instalasi dimulai.

Setelah berhasil instalasi, lakukan langkah berikut untuk setup database:
1. Buka 'localhost/phpmyadmin'.
2. Pilih New.
3. Buat database dengan nama 'willywangky'.
4. Pilih database 'willywangky'.
5. Pada menu, pilih Import.
6. Masukkan file dump database dari 'database/willywangky.sql'.
7. Pilih 'Go'.

## Cara menjalankan server
1. Clone repository ini.
2. Masukkan repository ini ke dalam folder 'htdocs' pada folder 'xampp'.
3. Buka XAMPP Control Panel.
4. Jalankan modul Apache dan MySQL.
5. Buka file 'php/connectDatabase.php' dan ganti username dan password sesuai dengan akun MySQL masing-masing.
6. Jalankan 'localhost:<port>/tugas-besar-1-2020/php/loginAccount.php' di browser yang mendukung.

## Screenshot
### Login Page
![](screenshot/Login.png)

### Register Page
![](screenshot/Register.png)

### Dashboard User
![](screenshot/Dashboard-user.png)

### Dashboard Superuser
![](screenshot/Dashboard-superuser.png)

### Search Result
![](screenshot/Search.png)

### Details Page User
![](screenshot/Details-user.png)

### Details Page Superuser
![](screenshot/Details-superuser.png)

### Buy Chocolate
![](screenshot/Buy-1.png)
![](screenshot/Buy-2.png)

### Add Stock Chocolate
![](screenshot/AddStock.png)

### Add New Chocolate
![](screenshot/AddNewChocolate.png)

### Transaction History
![](screenshot/History.png)



## Petunjuk Pengerjaan

1. Buatlah grup pada Gitlab dengan format "IF3110-2020-01-KXX-YY", dengan XX adalah nomor kelas dan YY adalah nomor kelompok.
2. Tambahkan anggota kelompok pada grup anda.
3. Fork pada repository ini dengan grup yang telah dibuat.
4. Ubah hak akses repository hasil Fork anda menjadi private.
5. Silakan commit pada repository anda (hasil fork). Lakukan beberapa commit dengan pesan yang bermakna, contoh: `add login form`, `fix login bug`, jangan seperti `final`, `dikit lagi`, `benerin bug`.
6. Buatlah file README yang berisi:
    * Deskripsi aplikasi web
    * Daftar requirement
    * Cara instalasi
    * Cara menjalankan server
    * Screenshot tampilan aplikasi, dan
    * Penjelasan mengenai pembagian tugas masing-masing anggota (lihat formatnya pada bagian pembagian tugas).

## Pengumpulan Tugas

Deadline tugas adalah pada hari Minggu, 25 Oktober 2020 pukul 19.00 WIB. Waktu pengumpulan tugas yang dilihat adalah waktu push ke server Gitlab terakhir.

## Pembagian Tugas

### Frontend
1. Login : 13518020
2. Register : 13518020
3. Dashboard : 13518050
4. Transaction History : 13518020
5. Details : 13518045
6. Buy Chocolate : 13518045
7. Add Stock : 13518045
8. Add New Chocolate : 13518045
9. Search Result : 13518050

### Backend
1. Login dan Logout : 13518020
2. Register : 13518020
3. Dashboard : 13518050
4. Transaction History : 13518020
5. Details : 13518045
6. Buy Chocolate : 13518045
7. Add Stock : 13518045
8. Add New Chocolate : 13518045
9. Search Result : 13518050

## About

Asisten IF3110 - 2020

Abel | Agwar | Asif | Iwang | Meyer | Vendra