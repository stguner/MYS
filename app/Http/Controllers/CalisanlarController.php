<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\calisan;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Validation\Rule;


class CalisanlarController extends Controller
{
    // Show all calisanlar
    public function index()
    {
        $calisanlar = calisan::All();
        return view('calisanlar',compact("calisanlar"));
    }

    public function calisanDuzenle($ctckn)
    {
        return view('calisanBilgileriDuzenle',['calisanlar' => calisan::where('ctckn',$ctckn)->first()]);
    }

    public function calisanGuncelle(Request $request, $ctckn){
        $request->validate([
            "ctckn" => "required",
            "cadi" => "required",
            "csoyadi" => "required",
            "cevadresil" => "required",
            "cevadresilce" => "required",
            "ctel" => "required",
            "ceposta" => "required",
            "cunvani" => "required",
            "ukodutel" => "required",
        ],
        [   
            'ctkn.required' => 'Lütfen çalışan TCKN boş bırakmayınız.',
            'cadi.required' => 'Lütfen çalışan adını boş bırakmayınız.',
            'csoyadi.required' => 'Lütfen çalışan soyadını boş bırakmayınız.',
            'cevadresil.required' => 'Lütfen il  boş bırakmayınız.',
            'cevadresilce.required' => 'Lütfen ilçeyi boş bırakmayınız.',
            'ctel.required' => 'Lütfen çalışan telefonunu boş bırakmayınız.',
            'ceposta.required' => 'Lütfen çalışan eposta boş bırakmayınız.',
            'cunvani.required' => 'Lütfen çalışan ünvanını boş bırakmayınız.',
            'ukodutel.required' => 'Lütfen telefon ülke kodunu boş bırakmayınız.',
        ]);
        $telNoUzunlugu = strlen($request->ctel);
        if($telNoUzunlugu != 10){ // Telefon Numarası 10 haneden az ise error döner
            return redirect()->back()->with("eksikTel","Yanlış Bir Telefon Numarası Girdiniz.");
        }else{
            calisan::where('ctckn', $request->ctckn)->update( array(
                'ctel' => $request->ctel, 
                'ukodutel' => $request->ukodutel,
                'ceposta' => $request->ceposta,
                'cunvani' => $request->cunvani,
                'cevadresil' => $request->cevadresil,
                'cevadresilce' => $request->cevadresilce,
                'ciban' => $request->ciban,
                'cbanka' => $request->cbanka,
                'chesapno' => $request->chesapno,
                'cevadres' => $request->cevadres,
             ));
    
            return redirect()->back()->with("success","Çalışan Başarıyla Güncellendi.");
        }
        
    }

    public function calisanSil($ctckn){
        calisan::where('ctckn', $ctckn)->delete();
        return redirect()->back()->with("success","Çalışan Başarıyla Silindi.");
    }

    public function calisanEkle(Request $request){
        $request->validate([
            "ctckn" => "required",
            "cadi" => "required",
            "csoyadi" => "required",
            "cevadresil" => "required|doesnt_start_with:Lütfen Bir İl Seçiniz",
            "cdogum" => "required|before:today",
            "cisegiris" => "required",
            "cevadresilce" => "required|doesnt_start_with:Lütfen Bir İlçe Seçiniz",
            "ctel" => "required",
            "ceposta" => "required",
            "cunvani" => "required",
            "ukodutel" => "required",
            "chesapno" => "required",
            "cbanka" => "required",
            "ciban" => "required",
        ],
        [   
            'cevadresil.doesnt_start_with' => 'Lütfen çalışanın ilini giriniz.',
            'cevadresilce.doesnt_start_with' => 'Lütfen çalışanın ilçesini giriniz.',
            'cadi.required' => 'Lütfen çalışan adını giriniz.',     
            'csoyadi.required' => 'Lütfen çalışan soyadını giriniz.',
            'ctckn.required' =>'Lütfen çalışan TCKN giriniz.',
            'ctel.required' =>'Lütfen çalışan telefonunu giriniz.',
            'ceposta.required' =>"Lütfen çalışan Eposta'sını giriniz.",
            'cunvani.required' =>'Lütfen çalışanın ünvanını giriniz.',
            'cevadresil.required' =>'Lütfen çalışanın ilini giriniz.',
            'cdogum.required' => 'Lütfen çalışanın doğum tarihini giriniz.',
            'cdogum.before' =>'Lütfen doğum gününü bugünden önce bir tarih seçiniz.',
            'cevadresilce.required' =>'Lütfen çalışanın ilçesini giriniz.',
            'cisegiris.required' => 'Lütfen çalışanın işe giriş tarihini giriniz',
            'ukodutel.required' =>'Lütfen çalışan telefonunun ülke kodunu giriniz.',
            'chesapno.required' =>'Lütfen çalışanın hesap numarasını giriniz.',
            'cbanka.required' =>'Lütfen çalışanın kullandığı banka adını giriniz.',
            'ciban.required' =>'Lütfen çalışanın ibanını giriniz.',
        ]
    
    );
    $calisanVarMi = calisan::where('ctckn', '=', $request->ctckn)->get();
    $calisanTckn = $calisanVarMi->count(); // Bu TCKN'ye sahip bir çalışanın olup olmadığını bulur.Eğer var ise çalışanı eklemez.
    $calisanSayisiBul = calisan::where('csatirid', '>', '0')->get();
    $calisanSayisi = $calisanSayisiBul->count(); // Kaç çalışan olduğunu saydırır.

        if($calisanTckn > 0){ //Çalışan zaten sisteme kayıtlıysa error dönsün.
            return redirect()->back()->with("calisanKayitli","Eklemeye Çalıştığınız Kişi Zaten Sisteme Kayıtlı. Lütfen Bilgileri Kontrol Ederek Tekrar Deneyiniz!");
        }else if($calisanSayisi > 0){ // Tablo boş değilse
            $sonCalisan = calisan::orderBy('csatirid', 'desc')->first()->csatirid; //Son Çalışanın Satır ID'sini getirir.
            calisan::create($request->all());
            calisan::where('ctckn', $request->ctckn)->update( array('cevadres' => $request->cevadres,'cwhatsapp'=>'wa.me/'.$request->ukodutel.''.$request->ctel.'', 'mysrefno'=>'sbe-'.$sonCalisan++.'','ciban' => $request->ciban,'chesapno' => $request->chesapno, 'cbanka' => $request->cbanka) );
            return redirect()->back()->with("success","Kayıt Başarıyla Eklendi!");
        }else{ // Tablo Boşsa
            calisan::create($request->all());
            calisan::where('ctckn', $request->ctckn)->update( array('cevadres' => $request->cevadres,'cwhatsapp'=>'wa.me/'.$request->ukodutel.''.$request->ctel.'', 'mysrefno'=>'sbe-1','ciban' => $request->ciban,'chesapno' => $request->chesapno, 'cbanka' => $request->cbanka ) );
            return redirect()->back()->with("success","Kayıt Başarıyla Eklendi!");
        }
    }

    public function ExportFormPDF() {
        $data = array();
        for ($i=0; $i < 25; $i++) { 
            $kontrol = "Lorem ipsum dolor sit amet consectetur adipisicing elit. Nisi, facilis?";
            $durum_int = random_int(0, 3);
            $durum = "";
            switch ($durum_int) {
                case 0:
                    $durum = "uygun";
                    break;
                case 1:
                    $durum = "uygun_degil";
                    break;
                case 2:
                    $durum = "onarildi";
                    break;
                case 3:
                    $durum = "yenilendi";
                    break;
            }
            $aciklama = "";
            if ($i % 4 == 0) {
                $aciklama = "Lorem ipsum dolor sit amet consectetur adipisicing elit.";
            }
            array_push($data, [
                "kontrol" => $kontrol,
                "durum" => $durum,
                "aciklama" => $aciklama
            ]);
        }
        $pdf = PDF::loadView('form', ['data' => $data]);
        return $pdf->download('form.pdf');
    }


    // public function calisanDetaylari($csatirid){
    //     $calisan = calisan::WHERE('csatirid',$csatirid)->first();
    //     $html = $calisan->cadi;
        
    //     if(!empty($calisan)){
    //         $html = '
    //         <div class="user-profile layout-spacing shadow">
    //             <div class="widget-content widget-content-area">
    //                 <div class="d-flex justify-content-center">
    //                     <h3 class="text-center align-items-center">Kişi Bilgileri</h3>
    //                 </div>
    //                 <div class="text-center user-info">
    //                     <p class="">'.$calisan->cadi.' '.$calisan->csoyadi.'</p>
    //                 </div>
    //                 <div class="user-info-list">

    //                     <div class="">
    //                         <ul class="contacts-block list-unstyled">
    //                             <li class="contacts-block__item">
    //                                 <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-coffee"><path d="M18 8h1a4 4 0 0 1 0 8h-1"></path><path d="M2 8h16v9a4 4 0 0 1-4 4H6a4 4 0 0 1-4-4V8z"></path><line x1="6" y1="1" x2="6" y2="4"></line><line x1="10" y1="1" x2="10" y2="4"></line><line x1="14" y1="1" x2="14" y2="4"></line></svg>'.$calisan->cunvani.'
    //                             </li>
    //                             <li class="contacts-block__item">
    //                                 <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg>'.$calisan->cdogum.'
    //                             </li>
    //                             <li class="contacts-block__item">
    //                                 <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-map-pin"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>'.$calisan->cevadresilce.', '.$calisan->cevadresil.'
    //                             </li>
    //                             <li class="contacts-block__item">
    //                                 <a href="mailto:example@mail.com"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg>'.$calisan->ceposta.'</a>
    //                             </li>
    //                             <li class="contacts-block__item">
    //                                 <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-phone"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>'.$calisan->ukodutel.' '.$calisan->ctel.'
    //                             </li>
    //                             <li class="contacts-block__item">
    //                                 <ul class="list-inline">
    //                                     <li class="list-inline-item">
    //                                         <div class="social-icon">
    //                                             <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-facebook"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>
    //                                         </div>
    //                                     </li>
    //                                     <li class="list-inline-item">
    //                                         <div class="social-icon">
    //                                             <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-twitter"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path></svg>
    //                                         </div>
    //                                     </li>
    //                                     <li class="list-inline-item">
    //                                         <div class="social-icon">
    //                                             <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-linkedin"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path><rect x="2" y="9" width="4" height="12"></rect><circle cx="4" cy="4" r="2"></circle></svg>
    //                                         </div>
    //                                     </li>
    //                                 </ul>
    //                             </li>
    //                         </ul>
    //                     </div>                                    
    //                 </div>
    //             </div>
    //         </div>
    //         ';
    //      }
    //      $response['html'] = $html;
   
    //      return response()->json($response);
    // }

    
}
