<?php

namespace App\Http\Controllers;
use App\Models\teklif;
use Illuminate\Http\Request;

class Teklifler extends Controller
{
    // Bütün Teklifleri Göster
    public function index()
    {
        $teklifler = teklif::All();
        return view('teklifler',compact("teklifler"));
    }

    public function teklifSil($id){
        teklif::where('id', $id)->delete();
        return redirect()->back()->with("success","Teklif Başarıyla Silindi.");
    }

    public function teklifGozat($id)
    {
        return view('teklif_gozat',['teklifler' => teklif::where('id',$id)->first()]);
    }

    public function teklifEkle(Request $request) {
        $request->validate([
            'yetkiliismi' => 'required',
            'yetkiliemail' => 'required|email',
            'musteriadres' => 'required',
            'musteritelefon' => 'required',
            'date' => 'required',
            'due' => 'required',
            'sirketismi' => 'required',
        ], [
            'yetkiliismi.required' => 'Lütfen isminizi giriniz',
            'yetkiliemail.required' => 'E-posta boş bırakılamaz',
            'yetkiliemail.email' => 'Lütfen geçerli bir E-posta girdiğinizden emin olunuz',
            'musteriadres.required' => 'Adres boş bırakılamaz',
            'musteritelefon.required' => 'Telefon numarası boş bırakılamaz',
            'date.required' => 'Teklif tarihi boş bırakılamaz',
            'due.required' => 'Teklifin bitiş tarihi boş bırakılamaz',
            'sirketismi.required' => 'Şirket ismi boş bırakılamaz.'
        ]);

            teklif::create(array('odeme_bilgileri_hesap_numarasi' => $request->hesap_numarasi ,'odeme_bilgileri_ulke_adi' => $request->ulke ,'odeme_bilgileri_swift_kodu' => $request->swift_kodu ,'odeme_bilgileri_banka_adi' => $request->banka_adi ,'istenilen_hizmet_miktar' => $request->urun_miktari1 ,'istenilen_hizmet_fiyat' => $request->urun_fiyati1 ,'istenilen_hizmetler' => $request->periyodik_bakim ,'teklif_baslangic_tarihi' => $request->date,'teklif_bitis_tarihi'=>$request->due, 'teklif_veren_isim' => $request->yetkiliismi,'teklif_veren_email' => $request->yetkiliemail,'teklif_veren_adres' => $request->musteriadres,'teklif_veren_telefon' => $request->musteritelefon ,'teklif_veren_sirket' => $request->sirketismi));
            return redirect('teklifler')->with("success","Teklif başarıyla oluşturuldu!");
    }

    public function teklifOnizle(Request $request){
        $request->validate([
            'yetkiliismi' => 'required',
            'yetkiliemail' => 'required|email',
            'musteriadres' => 'required',
            'musteritelefon' => 'required',
            'date' => 'required',
            'due' => 'required',
            'sirketismi' => 'required',
        ], [
            'yetkiliismi.required' => 'Lütfen isminizi giriniz',
            'yetkiliemail.required' => 'E-posta boş bırakılamaz',
            'yetkiliemail.email' => 'Lütfen geçerli bir E-posta girdiğinizden emin olunuz',
            'musteriadres.required' => 'Adres boş bırakılamaz',
            'musteritelefon.required' => 'Telefon numarası boş bırakılamaz',
            'date.required' => 'Teklif tarihi boş bırakılamaz',
            'due.required' => 'Teklifin bitiş tarihi boş bırakılamaz',
            'sirketismi.required' => 'Şirket ismi boş bırakılamaz.'
        ]);
        
        return view('teklif_onizle',['urun_miktari1' => $request->urun_miktari1, 'indirimsiz_toplam' => ($request->toplam_ucret_input + $request->indirim_miktari_input) , 'urun_fiyati1' => $request->urun_fiyati1, 'periyodik_bakim' => $request->periyodik_bakim, 'swift_kodu' => $request->swift_kodu, 'ulke' => $request->ulke, 'banka_adi' => $request->banka_adi, 'hesap_numarasi' => $request->hesap_numarasi , 'toplam_ucret_input' => $request->toplam_ucret_input, 'ara_toplam_input' => $request->ara_toplam_input, 'indirim_miktari_input' => $request->indirim_miktari_input, 'yetkiliismi' => $request->yetkiliismi , 'yetkiliemail' => $request->yetkiliemail , 'musteriadres' => $request->musteriadres , 'musteritelefon' => $request->musteritelefon , 'date' => $request->date , 'due' => $request->due , 'sirketismi' => $request->sirketismi, 'not' => $request->not]);
    }

    public function teklifEkleGiris(Request $request) {
        $request->validate([
            'yetkiliismi' => 'required',
            'yetkiliemail' => 'required|email',
            'musteriadres' => 'required',
            'musteritelefon' => 'required',
            'date' => 'required',
            'due' => 'required',
            'sirketismi' => 'required',
        ], [
            'yetkiliismi.required' => 'Lütfen isminizi giriniz',
            'yetkiliemail.required' => 'E-posta boş bırakılamaz',
            'yetkiliemail.email' => 'Lütfen geçerli bir E-posta girdiğinizden emin olunuz',
            'musteriadres.required' => 'Adres boş bırakılamaz',
            'musteritelefon.required' => 'Telefon numarası boş bırakılamaz',
            'date.required' => 'Teklif tarihi boş bırakılamaz',
            'due.required' => 'Teklifin bitiş tarihi boş bırakılamaz',
            'sirketismi.required' => 'Şirket ismi boş bırakılamaz.'
        ]);

            
            teklif::create(array('teklif_baslangic_tarihi' => $request->date,'teklif_bitis_tarihi'=>$request->due, 'teklif_veren_isim' => $request->yetkiliismi,'teklif_veren_email' => $request->yetkiliemail,'teklif_veren_adres' => $request->musteriadres,'teklif_veren_telefon' => $request->musteritelefon ,'teklif_veren_sirket' => $request->sirketismi));
            return redirect('giris_yap')->with("success","Teklif başarıyla oluşturuldu!");
    }

    public function teklifOnizleGiris(Request $request){
        $request->validate([
            'yetkiliismi' => 'required',
            'yetkiliemail' => 'required|email',
            'musteriadres' => 'required',
            'musteritelefon' => 'required',
            'date' => 'required',
            'due' => 'required',
            'sirketismi' => 'required',
        ], [
            'yetkiliismi.required' => 'Lütfen isminizi giriniz',
            'yetkiliemail.required' => 'E-posta boş bırakılamaz',
            'yetkiliemail.email' => 'Lütfen geçerli bir E-posta girdiğinizden emin olunuz',
            'musteriadres.required' => 'Adres boş bırakılamaz',
            'musteritelefon.required' => 'Telefon numarası boş bırakılamaz',
            'date.required' => 'Teklif tarihi boş bırakılamaz',
            'due.required' => 'Teklifin bitiş tarihi boş bırakılamaz',
            'sirketismi.required' => 'Şirket ismi boş bırakılamaz.',
        ]);
        
        return view('teklif_onizle_giris',['yetkiliismi' => $request->yetkiliismi , 'yetkiliemail' => $request->yetkiliemail , 'musteriadres' => $request->musteriadres , 'musteritelefon' => $request->musteritelefon , 'date' => $request->date , 'due' => $request->due , 'sirketismi' => $request->sirketismi , 'not' => $request->not]);
    }

}
