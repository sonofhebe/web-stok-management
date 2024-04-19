
<?php
defined('BASEPATH') or exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

//dashboar
$route['dashboard'] = 'Welcome/index';

//end dashboard

//page user
$route['data-user'] = 'User/index';
$route['tambah-user'] = 'User/tambahUser';
$route['edit-user/(:any)'] = 'User/editprofile/$1';
$route['hapus-user/(:any)'] = 'User/hapus/$1';
$route['password-edit/(:any)'] = 'User/password/$1';
$route['user-active/(:any)'] = 'User/aktif/$1';

$route['password-edit-user/(:any)'] = 'User/passworduser/$1';

$route['foto-edit-user/(:any)'] = 'User/editfoto/$1';


//satuan
$route['satuan'] = 'Satuan/index';
$route['tambah-data-satuan'] = 'Satuan/tambahdata';
$route['hapus-satuan/(:any)'] = 'Satuan/hapussatuan/$1';
$route['edit-satuan/(:any)'] = 'Satuan/editsatuan/$1';

//end satuan

//login
$route['Login'] = 'Auth/index';
$route['proses-login'] = 'Auth/proseslogin';
$route['logout'] = 'Auth/Logout';


//produk
//kategori produk
$route['kategoriproduk'] = 'kategoriproduk/index';
$route['tambah-kategoriproduk'] = 'kategoriproduk/tambahkategoriproduk';
$route['hapus-kategoriproduk/(:any)'] = 'kategoriproduk/hapuskategoriproduk/$1';
$route['edit-kategoriproduk/(:any)'] = 'kategoriproduk/editkategoriproduk/$1';

//kategori bahan
$route['kategori'] = 'Kategori/index';
$route['tambah-kategori'] = 'Kategori/tambahkategori';
$route['hapus-kategori/(:any)'] = 'Kategori/hapuskategori/$1';
$route['edit-kategori/(:any)'] = 'Kategori/editkategori/$1';

//jadwal
$route['jadwal'] = 'jadwal/index';
$route['inputsession-jadwal'] = 'data_jadwal/inputsession';
$route['data_jadwal'] = 'data_jadwal/index';
$route['tambah-jadwal'] = 'data_jadwal/tambahjadwal';
$route['hapus-jadwal/(:any)'] = 'data_jadwal/hapusjadwal/$1';

//data-produk
$route['data-produk'] = 'Produk/index';
$route['tambah-produk'] = 'Produk/tambahproduk';
$route['hapus-produk/(:any)'] = 'Produk/hapusproduk/$1';
$route['edit-produk/(:any)'] = 'Produk/editproduk/$1';
//variant
$route['data-produk/tambah-variant'] = 'Produk/tambahvariant';
$route['data-produk/hapus-variant/(:any)/(:any)'] = 'Produk/hapusvariant/$1/$2';
$route['data-produk/edit-variant/(:any)/(:any)'] = 'Produk/editvariant/$1/$2';
$route['data-produk/variant/(:any)'] = 'Produk/variant/$1';
//packaging
$route['data-produk/variant/packaging/tambah'] = 'Produk/tambahprodukpackaging';
$route['data-produk/variant/packaging/hapus/(:any)/(:any)'] = 'Produk/hapusprodukpackaging/$1/$2';
$route['data-produk/variant/packaging/edit/(:any)/(:any)'] = 'Produk/editprodukpackaging/$1/$2';
$route['data-produk/variant/packaging/(:any)'] = 'Produk/produkpackaging/$1';
//Resep
$route['data-produk/resep/tambah'] = 'Produk/tambahresep';
$route['data-produk/resep/hapus/(:any)/(:any)'] = 'Produk/hapusprodukresep/$1/$2';
$route['data-produk/resep/edit/(:any)/(:any)'] = 'Produk/editprodukresep/$1/$2';
$route['data-produk/resep/(:any)'] = 'Produk/resep/$1';
//Resep Detail
$route['data-produk/resep/detail/tambah'] = 'Produk/tambahresepdetail';
$route['data-produk/resep/detail/hapus/(:any)/(:any)'] = 'Produk/hapusprodukresepdetail/$1/$2';
$route['data-produk/resep/detail/edit/(:any)/(:any)'] = 'Produk/editprodukresepdetail/$1/$2';
$route['data-produk/resep/detail/(:any)'] = 'Produk/resepdetail/$1';

//data-bahan
$route['data-bahan'] = 'bahan/index';
$route['tambah-bahan'] = 'bahan/tambahbahan';
$route['hapus-bahan/(:any)'] = 'bahan/hapusbahan/$1';
$route['edit-bahan/(:any)'] = 'bahan/editbahan/$1';

//resep
$route['resep'] = 'resep/index';

//data resep
$route['inputsession-resep'] = 'data_resep/inputsession';
$route['data-resep'] = 'data_resep/index';
$route['tambah-resep'] = 'data_resep/tambahresep';
$route['hapus-resep/(:any)'] = 'data_resep/hapusresep/$1';
$route['edit-resep/(:any)'] = 'data_resep/editresep/$1';

//takaran
$route['takaran'] = 'takaran/index';
$route['tambah-takaran'] = 'takaran/tambahtakaran';
$route['hapus-takaran/(:any)'] = 'takaran/hapustakaran/$1';
$route['edit-takaran/(:any)'] = 'takaran/edittakaran/$1';

//produk keluar
$route['produk-keluar'] = 'Produk_keluar/index';
$route['tambah-produk-keluar'] = 'Produk_keluar/tambah';
$route['hapus-produk-keluar/(:any)'] = 'Produk_keluar/hapus/$1';

//Drop Stok
$route['drop-stok'] = 'drop_stok/index';
$route['drop-stok-'] = 'drop_stok/index2';
$route['tambah-drop-stok'] = 'drop_stok/tambah';
$route['hapus-drop-stok/(:any)'] = 'drop_stok/hapus/$1';
$route['bahan-masuk'] = 'drop_stok/cabang';

//request cabang
$route['request-cabang'] = 'request/index';
$route['request-cabang-'] = 'request/index2';
$route['tambah-request'] = 'request/tambah';
$route['hapus-request/(:any)'] = 'request/hapus/$1';

//request utama
$route['request-'] = 'request/utama2';
$route['request'] = 'request/utama';
$route['input-request/(:any)'] = 'request/input/$1';

//Pemakaian
$route['pemakaian'] = 'pemakaian/index';
$route['pemakaian-'] = 'pemakaian/index2';
$route['tambah-pemakaian'] = 'pemakaian/tambah';
$route['input-pemakaian'] = 'inputpemakaian/index';
$route['simpan-pemakaian'] = 'inputpemakaian/simpan';
$route['hapus-pemakaian/(:any)'] = 'pemakaian/hapus/$1';

//Penjualan
$route['penjualan'] = 'penjualan/index';
$route['penjualan-'] = 'penjualan/index2';
$route['tambah-penjualan'] = 'penjualan/tambahpenjualan';
$route['edit-penjualan/(:any)'] = 'penjualan/editpenjualan/$1';
$route['hapus-penjualan/(:any)'] = 'penjualan/hapuspenjualan/$1';

//dapur
$route['dapur'] = 'dapur/index';
$route['tambah-dapur'] = 'dapur/tambah';
$route['edit-dapur/(:any)'] = 'dapur/edit/$1';
$route['hapus-dapur/(:any)'] = 'dapur/hapus/$1';
$route['active/(:any)'] = 'dapur/aktif/$1';

//stok
$route['stok'] = 'stok/index';

//data stok
$route['inputsession-stok'] = 'data_stok/inputsession';
$route['data-stok'] = 'data_stok/index';
$route['tambah-stok'] = 'data_stok/tambahstok';
$route['hapus-stok/(:any)'] = 'data_stok/hapusstok/$1';
$route['edit-stok/(:any)'] = 'data_stok/editstok/$1';

//stok cabang
$route['stok-cabang'] = 'stok_cabang/index';

//cetak laporan
$route['laporan-pemakaian'] = 'laporan_pemakaian/index';
$route['laporan-drop'] = 'laporan_drop/index';
$route['laporan-penjualan'] = 'laporan_penjualan/index';

//laporan sc
$route['sc-mingguan'] = 'sc_mingguan/index';
$route['print-sc-mingguan'] = 'sc_mingguan/print';
$route['sc-bulanan'] = 'sc_bulanan/index';
$route['print-sc-bulanan'] = 'sc_bulanan/print';

//laporan pemakaian
$route['pemakaian-mingguan'] = 'pemakaian_mingguan/index';
$route['print-pemakaian-mingguan'] = 'pemakaian_mingguan/print';
$route['pemakaian-bulanan'] = 'pemakaian_bulanan/index';
$route['print-pemakaian-bulanan'] = 'pemakaian_bulanan/print';

//laporan drop stok
$route['drop-mingguan'] = 'drop_mingguan/index';
$route['print-drop-mingguan'] = 'drop_mingguan/print';
$route['drop-bulanan'] = 'drop_bulanan/index';
$route['print-drop-bulanan'] = 'drop_bulanan/print';

//laporan penjualan
$route['penjualan-mingguan'] = 'penjualan_mingguan/index';
$route['print-penjualan-mingguan'] = 'penjualan_mingguan/print';
$route['penjualan-bulanan'] = 'penjualan_bulanan/index';
$route['print-penjualan-bulanan'] = 'penjualan_bulanan/print';

//profile
$route['profiles-user'] = 'Profiles/index';

//tidak ada akses
$route['noaccess'] = 'noaccess/index';
