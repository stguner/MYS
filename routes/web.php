<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CalisanlarController;
use App\Http\Controllers\MusterilerController;
use App\Http\Controllers\AnasayfaController;
use App\Http\Controllers\ActivationCodeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Teklifler;

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


Route::get('/', [AnasayfaController::class, 'allData'])->name('anasayfa.index')->middleware('isAuthenticated');

Route::get('/musteriler', [MusterilerController::class, 'index'])->name('musteriler')->middleware('isAuthenticated');
Route::post('/musteriler', [MusterilerController::class, 'store'])->name('musteri.hizlikayit')->middleware('isAuthenticated');
Route::post('/musteri', [MusterilerController::class, 'musteriEkle'])->name('musteri.ekle')->middleware('isAuthenticated');
Route::get('/musteri/{mtcknvno}', [MusterilerController::class, 'musteriDuzenle'])->name('musteri.duzenle')->middleware('isAuthenticated');
Route::put('/musteri/{mtcknvno}', [MusterilerController::class, 'musteriGuncelle'])->name('musteri.guncelle')->middleware('isAuthenticated');
Route::delete('/musteri/{mtcknvno}', [MusterilerController::class, 'musteriSil'])->name('musteri.sil')->middleware('isAuthenticated');
Route::put('/MusteriProfilDuzenleme/{mtcknvno}', [MusterilerController::class, 'musteriGuncelleProfil'])->name('musteri.guncelle.profil')->middleware('isAuthenticated');


// Route::get('/musteri_ekle', function () {
//     return view('musteri_ekle');
// })->middleware('isAuthenticated');

Route::get('randevu_yonetimi', [CalisanlarController::class, 'GetRandevuYonetimi'])->middleware('isAuthenticated')->name('randevu_yonetimi');

Route::get('gorev_yonetimi', function () {
    return view('gorev_yonetimi');
})->middleware('isAuthenticated');

Route::get('calisan_ekle', function () {
    return view('calisan_ekle');
})->middleware('isAuthenticated');

Route::post('/calisan', [CalisanlarController::class, 'calisanEkle'])->name('calisan.ekle')->middleware('isAuthenticated');
Route::get('/calisan/{ctckn}', [CalisanlarController::class, 'calisanDuzenle'])->name('calisan.duzenle')->middleware('isAuthenticated');
Route::put('/calisan/{ctckn}', [CalisanlarController::class, 'calisanGuncelle'])->name('calisan.guncelle')->middleware('isAuthenticated');
Route::delete('/calisan/{ctckn}', [CalisanlarController::class, 'calisanSil'])->name('calisan.sil')->middleware('isAuthenticated');
Route::get('calisanlar', [CalisanlarController::class, 'index'])->name('calisan.index')->middleware('isAuthenticated');
Route::put('/CalisanProfilGuncelleme/{ctckn}', [CalisanlarController::class, 'calisanGuncelleProfil'])->name('calisan.guncelle.profil')->middleware('isAuthenticated');

Route::get('on_muhasebe', function () {
    return view('on_muhasebe');
})->middleware('isAuthenticated');

Route::get('kayit_ol', function () {
    return view('kayit_ol');
});

Route::get('musteri/giris_yap', function () {
    return view('musteri_giris_yap');
});

Route::get('giris_yap', function () {
    return view('firma_giris_yap');
})->name('giris_yap');

Route::post('giris_yap', [UserController::class, 'login'])->name('login');

Route::post('cikis_yap', [UserController::class, 'logout'])->name('logout')->middleware('isAuthenticated');

Route::post('kayit_ol', [UserController::class, 'register'])->name('register');

Route::get('profile', [UserController::class, 'GetProfile'])->name('profile');
Route::post('uploadPP', [UserController::class, 'UploadPP'])->name('uploadPP');
Route::get('profile/{tip}/{id}', [UserController::class, 'DeleteProfile'])->name('profile.delete');
Route::get('deleteCalisanByAdmin/{id}', [UserController::class, 'DeleteCalisanByAdmin'])->name('profile.deleteCalisanByAdmin');

Route::post('reset_activation_code', [ActivationCodeController::class, 'SendResetActivationCode'])->name('reset_activation_code');
Route::get('new_password', [UserController::class, 'GetNewPassword'])->name('get_new_password');
Route::post('new_password', [ActivationCodeController::class, 'NewPassword'])->name('new_password');

Route::get('load_bakim_formu/{form_adi}', [CalisanlarController::class, 'LoadBakimFormu'])->name('load_bakim_formu');
Route::post('submit_bakim_formu', [CalisanlarController::class, 'SubmitBakimFormu'])->name('submit_bakim_formu');
Route::get('bakim_formu_sonuclari', [CalisanlarController::class, 'BakimFormuSonuclari'])->name('bakim_formu_sonuclari');
Route::get('load_bakim_formu_sonucu/{form_id}', [CalisanlarController::class, 'LoadBakimFormuSonucu'])->name('load_bakim_formu_sonucu');
Route::get('formu_onayla/{form_id}', [CalisanlarController::class, 'FormuOnayla'])->name('formu_onayla');
Route::get('form_verify/{form_id}', [CalisanlarController::class, 'FormVerify'])->name('form_verify');

Route::get('example_form/{form_adi}', [CalisanlarController::class, 'ExampleForm'])->name('example_form');
Route::post('teklif_ekleme_yap', [Teklifler::class, 'teklifEkle'])->name('teklif.ekleme.yap')->middleware('isAuthenticated');
Route::delete('/teklif/{id}', [Teklifler::class, 'teklifSil'])->name('teklif.sil')->middleware('isAuthenticated');
Route::get('/teklif/{id}', [Teklifler::class, 'teklifGozat'])->name('teklif.gozat')->middleware('isAuthenticated');
Route::post('teklif_onizle', [Teklifler::class, 'teklifOnizle'])->name('teklif_onizle');
Route::post('teklif_onizle_giris', [Teklifler::class, 'teklifOnizleGiris'])->name('teklif_onizle_giris');
Route::get('teklifler', [Teklifler::class, 'index'])->name('teklifler.index')->middleware('isAuthenticated');
Route::get('teklif_duzenle', [Teklifler::class, 'teklifDuzenlemeyeDon'])->name('teklif.duzenle');

Route::get('hizmet_listeleme', [Teklifler::class, 'hizmetler'])->name('hizmet.listeleme')->middleware('isAuthenticated');

Route::get('teklif_yonetimi', function () {
    return view('teklif_yonetimi');
})->middleware('isAuthenticated');

Route::get('teklif_ekle', [Teklifler::class, 'teklifEkleLoad'])->name('teklif_ekle')->middleware('isAuthenticated');

Route::get('teklif_onizle', function () {
    return view('teklif_yonetimi');
})->middleware('isAuthenticated');

Route::get('paraCevir', [Teklifler::class, 'paraCevir'])->name('para.cevir');


Route::get('sifre_yenileme', function () {
    return view('sifre_yenileme');
});

Route::get('get_register_activation_code', [ActivationCodeController::class, 'GetRegisterActivationCode'])->name('get_register_activation_code');
Route::post('register_activation_code', [ActivationCodeController::class, 'SendRegisterActivationCode'])->name('register_activation_code');

Route::get('load_register_activation_code', [UserController::class, 'LoadRegisterActivationCode'])->name('load_register_activation_code');
Route::get('load_register_activation_code_musteri', [UserController::class, 'LoadRegisterActivationCode'])->name('load_register_activation_code_musteri');

Route::post('activate_account', [ActivationCodeController::class, 'ActivateAccount'])->name('activate_account');

Route::get('pages_error404', [UserController::class, 'Error404'])->name('pages_error404');
