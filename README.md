# Tugas 2 IF3110 Pengembangan Aplikasi Berbasis Web - Willy Wangky's Web

## Deskripsi Singkat

Willy Wangky's Web adalah aplikasi berbasis website yang dibuat menggunakan HTML, CSS, Javascript dasar, dan PHP. Web tersebut memungkinkan penggunanya dapat melakukan pendaftaran akun, login, logout, pencarian produk, mendapatkan penjelasan produk secara detail, pembelian produk dan dapat melihat riwayat pembelian produk, dan pekerjanya dapat dengan mudah menambahkan jenis coklat baru yang ingin dijual serta menambah ketersediaan coklat.

## Basis Data
![](screenshot/database.png)

### Tabel

| Nomor | Relasi | Penjelasan                                                                                     |
|-------|--------|------------------------------------------------------------------------------------------------|
| 1     | users  | Relasi ini berisi data pengguna website willy wangky, yaitu email, username, password, dan random string (token) untuk cookie          |
| 2     | transaction  | Relasi ini berisi data transaksi pengguna yang membeli cokelat         |
| 3     | product  | Relasi ini berisi data produk cokelat yang dijual di web          |
| 4     | addstock  | Relasi ini berisi data request penambahan stock ke ws-factory          |

## Screenshot
### Buy Chocolate
![](screenshot/Buy-1.png)
![](screenshot/Buy-2.png)

### Add Stock Chocolate
![](screenshot/AddStock.png)

### Add New Chocolate
![](screenshot/AddNew1.png)
![](screenshot/AddNew2.png)

## Pembagian Tugas

### REST
1. Transaksi bahan baku dengan Factory Management Pro : 13518020
2. Memberi daftar bahan yang dijual :

### SOAP
1. Login dan Logout : 13518045
2. Menambahkan jenis cokelat baru + resep :
3. Menambahkan permintaan add stock baru : 
4. Mengembalikan status dari permintaan add stock :
5. Melakukan pembuatan coklat tertentu dengan jumlah tertentu, yaitu mengubah bahan tidak kedaluwarsa dalam stok gudang Factory menjadi coklat (yang masih berada dalam gudang Factory) dan mengurangi bahan dalam gudang apabila bahan cukup :
6. Mengubah status permintaan add stock, dalam artian melakukan pengiriman terhadap toko Willy Wangky.
Menambah saldo yang pada Factory :
7. Mengembalikan saldo yang dimiliki pada Factory :
8. Menambahkan bahan dalam gudang : 


### ReactJs
1. Login : 13518045
2. Halaman Utama : 13518045
3. Memberikan approval terhadap pesanan coklat dari WWWeb :
4. Melihat daftar pemesanan coklat dari WWWeb :
5. Melihat daftar bahan yang tersedia di pabrik :
6. Melihat daftar harga bahan yang tersedia di supplier :
7. Membeli bahan dari supplier :
8. Melihat daftar resep coklat :
9. Melihat daftar coklat yang tersedia di pabrik :
10. Melihat saldo pabrik :
11. Memproduksi cokelat dari bahan mentah :

### Perubahan Willy Wangkys Web
1. Perubahan Tampilan Halaman Add New Chocolate : 13518045
2. Request penambahan jenis cokelat baru dan resepnya ke WS-factory pada halaman add new chocolate: 13518045
3. Request add stock ke WS-factory pada halaman add Stock: 13518045
3. Request penambahan saldo ke WS-factory pada halaman Buy Chocolate : 13518045
