<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['belum_login'])->group(function () {
    Route::get('/', 'DashboardController@index')->name('/');
    Route::post('aksilogin', 'DashboardController@loginAdmin')->name('aksilogin');
    Route::get('register', 'DashboardController@register')->name('register');
    Route::post('aksiregister', 'DashboardController@registerAdmin')->name('aksiregister');
});

Route::middleware(['sudah_login'])->group(function () {
    Route::get('dashboard', 'DashboardController@dashboard')->name('dashboard');
    Route::get('tabel', 'DashboardController@tabel')->name('tabel');
    Route::get('logout', 'DashboardController@logout')->name('logout');

    // user
    Route::get('user', 'UserController@index')->name('user');
    Route::get('user/create', 'UserController@create')->name('user.create');
    Route::post('user', 'UserController@store')->name('user.store');
    Route::get('user/{user}', 'UserController@edit')->name('user.edit');
    Route::put('user/{user}', 'UserController@update')->name('user.update');
    Route::delete('user/{user}', 'UserController@destroy')->name('user.delete');

    // pegawai
    Route::get('pegawai', 'PegawaiController@index')->name('pegawai');
    Route::get('pegawai/create', 'PegawaiController@create')->name('pegawai.create');
    Route::post('pegawai', 'PegawaiController@store')->name('pegawai.store');
    Route::get('pegawai/{pegawai}', 'PegawaiController@edit')->name('pegawai.edit');
    Route::put('pegawai/{pegawai}', 'PegawaiController@update')->name('pegawai.update');
    Route::delete('pegawai/{pegawai}', 'PegawaiController@destroy')->name('pegawai.delete');

    // jabatan
    Route::get('jabatan', 'JabatanController@index')->name('jabatan');
    Route::get('jabatan/create', 'JabatanController@create')->name('jabatan.create');
    Route::post('jabatan', 'JabatanController@store')->name('jabatan.store');
    Route::get('jabatan/{jabatan}', 'JabatanController@edit')->name('jabatan.edit');
    Route::put('jabatan/{jabatan}', 'JabatanController@update')->name('jabatan.update');
    Route::delete('jabatan/{jabatan}', 'JabatanController@destroy')->name('jabatan.delete');

    // kelas
    Route::get('kelas', 'KelasController@index')->name('kelas');
    Route::get('kelas/create', 'KelasController@create')->name('kelas.create');
    Route::post('kelas', 'KelasController@store')->name('kelas.store');
    Route::get('kelas/{kelas}', 'KelasController@edit')->name('kelas.edit');
    Route::put('kelas/{kelas}', 'KelasController@update')->name('kelas.update');
    Route::delete('kelas/{kelas}', 'KelasController@destroy')->name('kelas.delete');
    
    Route::get('kelas/get/{id}', 'KelasController@getKelas');


    // siswa
    Route::get('siswa', 'SiswaController@index')->name('siswa');
    Route::get('siswa/create', 'SiswaController@create')->name('siswa.create');
    Route::post('siswa', 'SiswaController@store')->name('siswa.store');
    Route::get('siswa/{siswa}', 'SiswaController@edit')->name('siswa.edit');
    Route::put('siswa/{siswa}', 'SiswaController@update')->name('siswa.update');
    Route::delete('siswa/{siswa}', 'SiswaController@destroy')->name('siswa.delete');
    
    // jam ajar
    Route::get('jam_ajar', 'JamAjarController@index')->name('jam_ajar');
    Route::get('jam_ajar/create', 'JamAjarController@create')->name('jam_ajar.create');
    Route::post('jam_ajar', 'JamAjarController@store')->name('jam_ajar.store');
    Route::get('jam_ajar/{jam_ajar}', 'JamAjarController@edit')->name('jam_ajar.edit');
    Route::put('jam_ajar/{jam_ajar}', 'JamAjarController@update')->name('jam_ajar.update');
    Route::delete('jam_ajar/{jam_ajar}', 'JamAjarController@destroy')->name('jam_ajar.delete');

    Route::get('jam_ajar/get/{id}', 'JamAjarController@getJam');

    
    // jadwal pelajaran
    Route::get('jadwal_pelajaran', 'JadwalPelajaranController@index')->name('jadwal_pelajaran');
    Route::get('jadwal_pelajaran/create', 'JadwalPelajaranController@create')->name('jadwal_pelajaran.create');
    Route::post('jadwal_pelajaran', 'JadwalPelajaranController@store')->name('jadwal_pelajaran.store');
    Route::get('jadwal_pelajaran/{jadwal_pelajaran}', 'JadwalPelajaranController@edit')->name('jadwal_pelajaran.edit');
    Route::put('jadwal_pelajaran/{jadwal_pelajaran}', 'JadwalPelajaranController@update')->name('jadwal_pelajaran.update');
    Route::delete('jadwal_pelajaran/{jadwal_pelajaran}', 'JadwalPelajaranController@destroy')->name('jadwal_pelajaran.delete');
    
    // mata pelajaran
    Route::get('pelajaran', 'PelajaranController@index')->name('pelajaran');
    Route::get('pelajaran/create', 'PelajaranController@create')->name('pelajaran.create');
    Route::post('pelajaran', 'PelajaranController@store')->name('pelajaran.store');
    Route::get('pelajaran/{pelajaran}', 'PelajaranController@edit')->name('pelajaran.edit');
    Route::put('pelajaran/{pelajaran}', 'PelajaranController@update')->name('pelajaran.update');
    Route::delete('pelajaran/{pelajaran}', 'PelajaranController@destroy')->name('pelajaran.delete');
    
    // hari
    Route::get('hari', 'HariController@index')->name('hari');
    Route::get('hari/create', 'HariController@create')->name('hari.create');
    Route::post('hari', 'HariController@store')->name('hari.store');
    Route::get('hari/{hari}', 'HariController@edit')->name('hari.edit');
    Route::put('hari/{hari}', 'HariController@update')->name('hari.update');
    Route::delete('hari/{hari}', 'HariController@destroy')->name('hari.delete');
    
    // lapor
    Route::get('lapor', 'LaporController@index')->name('lapor');
    Route::get('lapor/create', 'LaporController@create')->name('lapor.create');
    Route::post('lapor', 'LaporController@store')->name('lapor.store');
    Route::get('lapor/{lapor}', 'LaporController@edit')->name('lapor.edit');
    Route::put('lapor/{lapor}', 'LaporController@update')->name('lapor.update');
    Route::delete('lapor/{lapor}', 'LaporController@destroy')->name('lapor.delete');
    
    // absensi
    Route::get('absensi', 'AbsensiController@index')->name('absensi');
    Route::get('absensi/create', 'AbsensiController@create')->name('absensi.create');
    Route::post('absensi', 'AbsensiController@store')->name('absensi.store');
    Route::get('absensi/{absensi}', 'AbsensiController@edit')->name('absensi.edit');
    Route::put('absensi/{absensi}', 'AbsensiController@update')->name('absensi.update');
    Route::delete('absensi/{absensi}', 'AbsensiController@destroy')->name('absensi.delete');

    // blogs
    Route::get('blogs', 'BlogController@index')->name('blogs');
    Route::get('blogs/create', 'BlogController@create')->name('blogs.create');
    Route::post('blogs', 'BlogController@store')->name('blogs.store');
    Route::get('blogs/{blog}', 'BlogController@edit')->name('blogs.edit');
    Route::put('blogs/{blog}', 'BlogController@update')->name('blogs.update');
    Route::delete('blogs/{blog}', 'BlogController@destroy')->name('blogs.delete');

    Route::get('blogs/comment/{blog}', 'BlogController@comment')->name('blogs.comment');
    Route::delete('comments/{comment}', 'BlogController@destroy_comment')->name('comments.delete');

    // product
    Route::get('products', 'ProductController@index')->name('products');
    Route::get('products/create', 'ProductController@create')->name('products.create');
    Route::post('products', 'ProductController@store')->name('products.store');
    Route::get('products/{product}', 'ProductController@edit')->name('products.edit');
    Route::put('products/{product}', 'ProductController@update')->name('products.update');
    Route::delete('products/{product}', 'ProductController@destroy')->name('products.delete');
    
    Route::get('products/foto/{product}', 'ProductController@foto')->name('products.foto');
    Route::get('product_photos/create_foto/{product}', 'ProductController@create_foto')->name('product_photos.create');
    Route::post('product_photos', 'ProductController@store_foto')->name('product_photos.store');
    Route::get('product_photos/{product_photo}', 'ProductController@edit_foto')->name('product_photos.edit');
    Route::put('product_photos/{product_photo}', 'ProductController@update_foto')->name('product_photos.update');
    Route::delete('product_photos/{product_photo}', 'ProductController@destroy_foto')->name('product_photos.delete');

    // regions
    Route::get('regions', 'RegionController@index')->name('regions');
    Route::get('regions/create', 'RegionController@create')->name('regions.create');
    Route::post('regions', 'RegionController@store')->name('regions.store');
    Route::get('regions/{region}', 'RegionController@edit')->name('regions.edit');
    Route::put('regions/{region}', 'RegionController@update')->name('regions.update');
    Route::delete('regions/{region}', 'RegionController@destroy')->name('regions.delete');

    Route::get('regions/detail/{region}', 'RegionController@region_detail')->name('regions.detail');
    Route::get('region_details/create_detail/{region}', 'RegionController@create_detail')->name('region_details.create');
    Route::post('region_details', 'RegionController@store_detail')->name('region_details.store');
    Route::get('region_details/{region_detail}', 'RegionController@edit_detail')->name('region_details.edit');
    Route::put('region_details/{region_detail}', 'RegionController@update_detail')->name('region_details.update');
    Route::delete('region_details/{region_detail}', 'RegionController@destroy_detail')->name('region_details.delete');

    // mitra kerja
    Route::get('mitra', 'TestimoniController@index')->name('mitra');
    Route::get('mitra/create', 'TestimoniController@create')->name('mitra.create');
    Route::post('mitra', 'TestimoniController@store')->name('mitra.store');
    Route::get('mitra/{testimoni}', 'TestimoniController@edit')->name('mitra.edit');
    Route::put('mitra/{testimoni}', 'TestimoniController@update')->name('mitra.update');
    Route::delete('mitra/{testimoni}', 'TestimoniController@destroy')->name('mitra.delete');

    // testimonial
    Route::get('testimonials', 'TestimonialController@index')->name('testimonials');
    Route::get('testimonials/create', 'TestimonialController@create')->name('testimonials.create');
    Route::post('testimonials', 'TestimonialController@store')->name('testimonials.store');
    Route::get('testimonials/create', 'TestimonialController@create')->name('testimonials.create');
    Route::get('testimonials/{testimonial}', 'TestimonialController@edit')->name('testimonials.edit');
    Route::put('testimonials/{testimonial}', 'TestimonialController@update')->name('testimonials.update');
    Route::delete('testimonials/{testimonial}', 'TestimonialController@destroy')->name('testimonials.delete');
    
    Route::get('testimonials/kecamatan/{id}', 'TestimonialController@kecamatan')->name('testimonials.kecamatan');

    // custom
    Route::get('customs', 'CustomController@index')->name('customs');
    Route::get('customs/create', 'CustomController@create')->name('customs.create');
    Route::post('customs', 'CustomController@store')->name('customs.store');
    Route::get('customs/{custom}', 'CustomController@edit')->name('customs.edit');
    Route::put('customs/{custom}', 'CustomController@update')->name('customs.update');
    Route::delete('customs/{custom}', 'CustomController@destroy')->name('customs.delete');

    // sparepart
    Route::get('spareparts', 'SparepartController@index')->name('spareparts');
    Route::get('spareparts/create', 'SparepartController@create')->name('spareparts.create');
    Route::post('spareparts', 'SparepartController@store')->name('spareparts.store');
    Route::get('spareparts/{sparepart}', 'SparepartController@edit')->name('spareparts.edit');
    Route::put('spareparts/{sparepart}', 'SparepartController@update')->name('spareparts.update');
    Route::delete('spareparts/{sparepart}', 'SparepartController@destroy')->name('spareparts.delete');

    // promos
    Route::get('promos', 'PromoController@index')->name('promos');
    Route::get('promos/create', 'PromoController@create')->name('promos.create');
    Route::post('promos', 'PromoController@store')->name('promos.store');
    Route::get('promos/{promo}', 'PromoController@edit')->name('promos.edit');
    Route::put('promos/{promo}', 'PromoController@update')->name('promos.update');
    Route::delete('promos/{promo}', 'PromoController@destroy')->name('promos.delete');

    // legalitas
    Route::get('legalitas', 'LegalitasController@index')->name('legalitas');
    Route::get('legalitas/create', 'LegalitasController@create')->name('legalitas.create');
    Route::post('legalitas', 'LegalitasController@store')->name('legalitas.store');
    Route::get('legalitas/{legalitas}', 'LegalitasController@edit')->name('legalitas.edit');
    Route::put('legalitas/{legalitas}', 'LegalitasController@update')->name('legalitas.update');
    Route::delete('legalitas/{legalitas}', 'LegalitasController@destroy')->name('legalitas.delete');

});
