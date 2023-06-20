<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\calisan;
use App\Models\musteri;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;
// use Illuminate\Support\Facades\Redis;
use Deligoez\TCKimlikNo\TCKimlikNo;

class UserController extends Controller
{

    public function login(Request $request)
    {
        if ($request->tip == "Çalışan") {
            $request->validate([
                'ckullaniciadi' => 'required',
                'csifre' => 'required'
            ], [
                'ckullaniciadi.required' => 'Kullanıcı adı boş bırakılamaz',
                'csifre.required' => 'Şifre boş bırakılamaz'
            ]);

            $kullanici = calisan::where('ckullaniciadi', $request->input('ckullaniciadi'))->first();
            $tckn = calisan::where('ctckn', $request->input('ckullaniciadi'))->first();

            if ($kullanici && Hash::check($request->input('csifre'), $kullanici->csifre)) {
                $request->session()->put('kullanici', $kullanici);
                $request->session()->put('tip', 'Çalışan');
                return redirect()->route('anasayfa.index');
            } else if ($tckn && Hash::check($request->input('csifre'), $kullanici->csifre)) {
                $request->session()->put('kullanici', $tckn);
                $request->session()->put('tip', 'Çalışan');
                return redirect()->route('anasayfa.index');
            } else {
                return back()->withErrors(['ckullaniciadi' => 'Kullanıcı adı/TCKN veya şifre hatalı!'])->onlyInput('ckullaniciadi');
            }
        } else if ($request->tip == "Müşteri") {
            $request->validate([
                'mkullaniciadi' => 'required',
                'msifre' => 'required'
            ], [
                'mkullaniciadi.required' => 'Kullanıcı adı boş bırakılamaz',
                'msifre.required' => 'Şifre boş bırakılamaz'
            ]);

            $kullanici = musteri::where('mkullaniciadi', $request->input('mkullaniciadi'))->first();
            $tckn = musteri::where('mtcknvno', $request->input('mkullaniciadi'))->first();
            if ($kullanici && Hash::check($request->input('msifre'), $kullanici->msifre)) {
                $request->session()->put('kullanici', $kullanici);
                $request->session()->put('tip', 'Müşteri');
                return redirect()->route('anasayfa.index');
            } else if ($tckn && Hash::check($request->input('msifre'), $kullanici->msifre)) {
                $request->session()->put('kullanici', $tckn);
                $request->session()->put('tip', 'Müşteri');
                return redirect()->route('anasayfa.index');
            } else {
                return back()->withErrors(['mkullaniciadi' => 'Kullanıcı adı/TCKN veya şifre hatalı!'])->onlyInput('mkullaniciadi');
            }
        } else {
            return redirect()->route('pages_error404');
        }
    }

    public function register(Request $request)
    {
        if ($request->tip == "musteri") {
            $request->validate([
                'mbadi' => 'required',
                'mbsoyadi' => 'required',
                'meposta' => 'required|email',
                'mtcknvno' => 'required',
                'mkullaniciadi' => 'required',
                'msifre' => 'required',
                'mbdogumgunu' => 'required',
                'mtel' => 'required',
                'mkayitturu' => 'required|doesnt_start_with:Kayıt Türü',
                'mbfirmaadi' => 'required',
                'mbunvani' => 'required',
                'menlem' => 'required',
                'mboylam' => 'required',
                'madres' => 'required',
                'mil' => 'required|doesnt_start_with:İl',
                'milce' => 'required|doesnt_start_with:İlçe',
                'mbolge' => 'required',
            ], [
                'mkullaniciadi.required' => 'Kullanıcı adı boş bırakılamaz',
                'mbadi.required' => 'Ad boş bırakılamaz',
                'meposta.required' => 'E-posta boş bırakılamaz',
                'meposta.email' => 'Geçerli bir e-posta adresi giriniz',
                'msifre.required' => 'Şifre boş bırakılamaz',
                'mtcknvno.required' => 'TCKN boş bırakılamaz',
                'mbsoyadi.required' => 'Soyad boş bırakılamaz',
                'mbdogumgunu.required' => 'Doğum günü boş bırakılamaz',
                'mtel.required' => 'Telefon numarası boş bırakılamaz',
                'mkayitturu.required' => 'Kayıt türü boş bırakılamaz',
                'mkayitturu.doesnt_start_with' => 'Kayıt türü boş bırakılamaz',
                'mbfirmaadi.required' => 'Firma adı  boş bırakılamaz',
                'mbunvani.required' => 'Lütfen ünvanınızı giriniz',
                'menlem.required' => 'Haritadan şirket adresini seçiniz',
                'mboylam.required' => 'Haritadan şirket adresini seçiniz',
                'madres.required' => 'Adres boş bırakılamaz',
                'mil.required' => 'Lütfen il seçiniz.',
                'mil.doesnt_start_with' => 'Lütfen il seçiniz.',
                'milce.required' => 'Lütfen ilçe seçiniz.',
                'milce.doesnt_start_with' => 'Lütfen ilçe seçiniz.',
                'mbolge.required' => 'Bölge ismi boş bırakılamaz'
            ]);

            $kullanici = musteri::where('mkullaniciadi', $request->input('mkullaniciadi'))->first();
            $tckn = musteri::where('mtcknvno', $request->input('mtcknvno'))->first();
            // MERNIS kontrolu
            // if (!TCKimlikNo::validate($request->mtcknvno, $request->mbadi, $request->mbsoyadi, explode("-", $request->mbdogumgunu)[0])) {
            //     return back()->withErrors(['mernis' => 'Geçersiz kimlik bilgileri!'])->onlyInput('username');
            // }
            if ($kullanici) {
                return back()->withErrors(['username' => 'Kullanıcı adı/TCKN kullanımda!'])->onlyInput('username');
            } else if ($tckn) {
                return back()->withErrors(['ctckn' => 'TCKN kullanımda!'])->onlyInput('ctckn');
            } else {
                $kullanici = new musteri();
                $kullanici->mkullaniciadi = $request->input('mkullaniciadi');
                $kullanici->msifre = Hash::make($request->input('msifre'));
                $kullanici->meposta = $request->input('meposta');
                $kullanici->mbadi = $request->input('mbadi');
                $kullanici->mbsoyadi = $request->input('mbsoyadi');
                $kullanici->mtcknvno = $request->input('mtcknvno');
                $kullanici->mbdogumgunu = $request->input('mbdogumgunu');
                $kullanici->mtel = $request->input('mtel');
                $kullanici->mkayitturu = $request->input('mkayitturu');
                $kullanici->mbfirmaadi = $request->input('mbfirmaadi');
                $kullanici->mbunvani = $request->input('mbunvani');
                $kullanici->menlem = $request->input('menlem');
                $kullanici->mboylam = $request->input('mboylam');
                $kullanici->madres = $request->input('madres');
                $kullanici->mil = $request->input('mil');
                $kullanici->milce = $request->input('milce');
                $kullanici->mphoto = asset('assets/img/img_avatar.png');
                $kullanici->mbolge = $request->input('mbolge');
                $kullanici->mfaks = $request->input('mfaks');

                $kullanici->save();
                return view('get_register_activation_code', ['tip' => 'Müşteri']);
            }
        } else if ($request->tip == "calisan") {
            $request->validate([
                'ckullaniciadi' => 'required',
                'cadi' => 'required',
                'ceposta' => 'required|email',
                'csifre' => 'required',
                'ctckn' => 'required',
                'csoyadi' => 'required',
                'cdogum' => 'required',
                'ctel' => 'required',
                'cisegiris' => 'required',
                'cunvani' => 'required',
            ], [
                'ckullaniciadi.required' => 'Kullanıcı adı boş bırakılamaz',
                'cadi.required' => 'Ad boş bırakılamaz',
                'ceposta.required' => 'E-posta boş bırakılamaz',
                'ceposta.email' => 'Geçerli bir e-posta adresi giriniz',
                'csifre.required' => 'Şifre boş bırakılamaz',
                'ctckn.required' => 'TCKN boş bırakılamaz',
                'csoyadi.required' => 'Soyad boş bırakılamaz',
                'cdogum.required' => 'Doğum günü boş bırakılamaz',
                'ctel.required' => 'Telefon numarası boş bırakılamaz',
                'cunvani.required' => 'Ünvan boş bırakılamaz',
                'cisegiris.required' => 'Lütfen işe giriş tarihinizi giriniz'
            ]);

            $kullanici = calisan::where('ckullaniciadi', $request->input('ckullaniciadi'))->first();
            $tckn = calisan::where('ctckn', $request->input('ctckn'))->first();
            // MERNIS kontrolu
            // if (!TCKimlikNo::validate($request->ctckn, $request->cadi, $request->csoyadi, explode("-", $request->cdogum)[0])) {
            //     return back()->withErrors(['mernis' => 'Geçersiz kimlik bilgileri!'])->onlyInput('username');
            // }
            if ($kullanici) {
                return back()->withErrors(['username' => 'Kullanıcı adı/TCKN kullanımda!'])->onlyInput('username');
            } else if ($tckn) {
                return back()->withErrors(['ctckn' => 'TCKN kullanımda!'])->onlyInput('ctckn');
            } else {
                $kullanici = new calisan();
                $kullanici->ckullaniciadi = $request->input('ckullaniciadi');
                $kullanici->csifre = Hash::make($request->input('csifre'));
                $kullanici->ceposta = $request->input('ceposta');
                $kullanici->cadi = $request->input('cadi');
                $kullanici->csoyadi = $request->input('csoyadi');
                $kullanici->ctckn = $request->input('ctckn');
                $kullanici->cdogum = $request->input('cdogum');
                $kullanici->ctel = $request->input('ctel');
                $kullanici->cphoto = asset('assets/img/img_avatar.png');
                $kullanici->cunvani = $request->input('cunvani');
                $kullanici->cisegiris = $request->input('cisegiris');
                $kullanici->save();
                return view('get_register_activation_code', ['tip' => 'Çalışan']);
            }
        } else {
            return back()->withErrors(['gecersizTip' => 'Kayıt olurken bir hata oluştu. Lütfen bizimle iletişime geçiniz.']);
        }
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect()->route('giris_yap');
    }

    public function GetProfile(Request $request)
    {
        if (session('tip') == 'Müşteri') {
            $musteri = musteri::where('mkullaniciadi', $request->session()->get('kullanici')->mkullaniciadi)->first();
            if ($musteri->mphoto != null or $musteri->mphoto != '') {
                $musteri->mphoto = Storage::url('photos/') . $musteri->mphoto;
            } else {
                $musteri->mphoto = asset('assets/img/img_avatar.png');
            }

            return view('profile', ['musteri' => $musteri]);
        } else if (session('tip') == 'Çalışan') {
            $kullanici = calisan::where('ckullaniciadi', $request->session()->get('kullanici')->ckullaniciadi)->first();
            if ($kullanici->cphoto != null or $kullanici->cphoto != '') {
                $kullanici->cphoto = Storage::url('photos/') . $kullanici->cphoto;
            } else {
                $kullanici->cphoto = asset('assets/img/img_avatar.png');
            }

            return view('profile', ['kullanici' => $kullanici]);
        } else {
            return redirect()->route('pages_error404');
        }
    }

    public function UploadPP(Request $request)
    {
        if ($request->tip == "Müşteri") {
            $path = $request->file('photo')->store('public/photos');
            $filename = explode('/', $path)[2];
            $kullanici = musteri::where('mkullaniciadi', session('kullanici')->mkullaniciadi)->first();
            $kullanici->update(['mphoto' => $filename]);
            session()->put('kullanici', $kullanici);
            return redirect()->route('profile', ['kullanici' => $kullanici]);
        } else {
            $path = $request->file('photo')->store('public/photos');
            $filename = explode('/', $path)[2];
            $kullanici = calisan::where('ckullaniciadi', session('kullanici')->ckullaniciadi)->first();
            $kullanici->update(['cphoto' => $filename]);

            session()->put('kullanici', $kullanici);
            return redirect()->route('profile', ['kullanici' => $kullanici]);
        }
    }

    public function GetNewPassword(Request $request)
    {
        return view('sifre_yenileme_kod', ['eposta' => $request->query('eposta')]);
    }

    public function LoadRegisterActivationCode(Request $request)
    {
        if ($request->tip == "Çalışan") {
            return view('load_register_activation_code', ['ceposta' => $request->query('ceposta'), 'tip' => 'Çalışan']);
        } else if ($request->tip == "Müşteri") {
            return view('load_register_activation_code_musteri', ['meposta' => $request->query('meposta'), 'tip' => 'Müşteri']);
        } else {
            return redirect()->route('pages_error404');
        }
    }

    public function Error404()
    {
        return view('pages_error404');
    }
}
