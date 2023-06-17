<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>MYS - MÜŞTERİ YÖNETİMİ</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon.ico') }}" />
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <x-global-mandatory.styles />
    <!-- END GLOBAL MANDATORY STYLES -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/solid.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/svg-with-js.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/css/intlTelInput.css">
    <style>
        body {
            font-family: sans-serif;
        }

        #map {
            height: 300px;
            width: 100%;
        }

        .profilepic {
            position: relative;
            width: 100%;
            height: auto;
            border-radius: 50%;
            overflow: hidden;
            background-color: #111;
        }

        .profilepic:hover .profilepic__content {
            opacity: 1;
        }

        .profilepic:hover .profilepic__image {
            opacity: .5;
        }

        .profilepic__image {
            width: 100%;
            height: auto;
            object-fit: cover;
            opacity: 1;
            transition: opacity .2s ease-in-out;
        }

        .profilepic__content {
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: white;
            opacity: 0;
            transition: opacity .2s ease-in-out;
        }

        .profilepic__icon {
            color: white;
            padding-bottom: 8px;
        }

        .fas {
            font-size: 20px;
        }

        .profilepic__text {
            text-transform: uppercase;
            font-size: 12px;
            width: 100%;
            text-align: center;
        }

        .profilepic__text {
            background-color: darkblue;
            color: white;
            padding: 0.5rem;
            font-family: sans-serif;
            border-radius: 0.3rem;
            cursor: pointer;
            margin-top: 1rem;
        }

        #upload_button_div {
            text-align: center;
            margin-top: 5%;
        }

        #upload_button {
            text-align: center;
            margin-top: 5%;
            font-size: 16px;
            background-color: darkblue;
            color: white;
            padding: 0.5rem;
            border-radius: 0.3rem;
            font-family: sans-serif;
        }
    </style>
    <link href="{{ asset('assets/css/authentication/form-1.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/users/account-setting.css') }}"/>
    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->

</head>

<body class="sidebar-noneoverflow">

    <!--  BEGIN NAVBAR  -->
    <x-topbar />
    <!--  END NAVBAR  -->

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">

        <div class="overlay"></div>
        <div class="search-overlay"></div>

        <!--  BEGIN TOPBAR  -->
        <x-navbar />
        <!--  END TOPBAR  -->
                    @if(Session::has("success"))
                        <div class="alert alert-success">
                            {{Session::get("success")}}
                        </div>
                    @endif
                    @if(Session::has("eksikTel"))
                        <div class="alert alert-danger">
                            {{Session::get("eksikTel")}}
                        </div>
                    @endif
        <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">
                @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                <!-- CONTENT AREA -->
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-12 layout-top-spacing layout-spacing">
                        <div class="widget widget-content-area br-4">
                            <div class="widget-one">
                                <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                                    <div class="row">
                                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 text-center">
                                            <div class="section-title">
                                                <h3 class="font-weight-bold">PROFİL BİLGİLERİ</h3>
                                                <hr>
                                            </div>
                                        </div>
                                    </div>
                                    @if (session('tip') == 'Çalışan') <!-- Çalışan Güncelleme Kısmı -->
                                    <div class="row">
                                        <div class="col-3">
                                            <div class="profilepic" style="border-radius: 20%;">
                                                <img class="profilepic__image" alt="Profil Resmi"
                                                    src="{{ $kullanici->cphoto }}" />
                                                <div class="profilepic__content">
                                                    <span class="profilepic__icon"><i class="fas fa-camera"></i></span>
                                                    <form method="post" action="{{ route('uploadPP', ["tip" => "Çalışan"]) }}"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        <input type="file" id="actual-btn" name="photo"
                                                         onchange="javascript:document.getElementById('upload_button').hidden = false;" hidden />
                                                        <label for="actual-btn" class="profilepic__text"> Fotoğrafı Düzenle</label>
                                                    
                                                </div>

                                            </div>
                                            <div id="upload_button_div"><button type="submit" id="upload_button" hidden>Yükle</button></div>
                                        </form>
                                        </div>

                                        <div class="col-9 px-4">
                                            <form id="kisiBilgileri" class="section contact" method="post" action="{{route('calisan.guncelle.profil',["ctckn" => $kullanici->ctckn])}}" >
                                                @csrf
                                                @method("put")
                                                <div class="info bg-light">
                                                    <div class="row">
                                                        <div class="col-md-11 mx-auto">
                                                            <span class="badge badge-primary font-weight-bold w-100 te" style="font-size:20px;">Kişisel Bilgiler</span>
                                                            <div class="row mt-2">
                                                                <div class="col-md-3">
                                                                    <div class="form-group">
                                                                        <label for="ad">Ad</label>
                                                                        <input onkeypress="guncelleGoster()" type="text" class="form-control mb-4"  name="cadi"  value="{{$kullanici->cadi}}" readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <div class="form-group">
                                                                        <label for="soyad">Soyad</label>
                                                                        <input onkeypress="guncelleGoster()" type="text" class="form-control mb-4" name="csoyadi"   value="{{$kullanici->csoyadi}}" readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <div class="form-group">
                                                                        <label for="tckn">TCKN</label>
                                                                        <input onkeypress="guncelleGoster()" type="text" class="form-control mb-4" name="ctckn" onkeypress='return event.charCode >= 48 && event.charCode <= 57' value="{{$kullanici->ctckn}}" readonly>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-group">
                                                                        <label for="website1">Ünvan</label>
                                                                        <input onkeypress="guncelleGoster()" type="text" class="form-control mb-4" name="cunvani" id="website1" placeholder="Ünvan" value="{{$kullanici->cunvani}}">
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <div class="form-group">
                                                                        <label for="dg">Doğum Günü</label>
                                                                        <input onkeypress="guncelleGoster()" type="date" class="form-control mb-4"  name="cdogum" id="dogumgunu" value="{{$kullanici->cdogum}}">
                                                                    </div>
                                                                </div>
                                                                </div>
                                                                <hr>
                                                                <span class="badge badge-primary font-weight-bold w-100" style="font-size:20px;">İletişim Bilgileri</span>
                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label for="phone">Telefon Numarası</label>
                                                                            <input onkeypress="guncelleGoster()" type="text" class="form-control mb-4" name="ctel" id="telefon_calisan" placeholder="Telefon Numarası" value="{{$kullanici->ctel}}" required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label for="email">Eposta</label>
                                                                            <input onkeypress="guncelleGoster()" type="text" class="form-control mb-4" name="ceposta" id="email" placeholder="Eposta" value="{{$kullanici->ceposta}}" required>
                                                                        </div>
                                                                    </div>
                                                                </div> 
                                                                <hr>
                                                                <span class="badge badge-primary font-weight-bold w-100" style="font-size:20px;">Adres Bilgileri</span>
                                                                <div class="row">                                   
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label for="location">İl</label>
                                                                            <select onchange="guncelleGoster()" id="Iller" name="cevadresil" class="placeholder js-states form-control">
                                                                                <option value="{{$kullanici->cevadresil}}">{{$kullanici->cevadresil}}</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-group">
                                                                            <label for="location">İlçe</label>
                                                                            <select onchange="guncelleGoster()" id="Ilceler" name="cevadresilce" class="placeholder js-states form-control">
                                                                                <option value="{{$kullanici->cevadresilce}}" selected>{{$kullanici->cevadresilce}}</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <div class="form-group">
                                                                            <label for="location">Adres</label>
                                                                            <textarea onkeypress="guncelleGoster()" class="form-control mb-4" style="resize:none;" id="cevadres" name="cevadres" placeholder="Adres" rows="2">{{$kullanici->cevadres}}</textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <hr>
                                                                <span class="badge badge-primary font-weight-bold w-100" style="font-size:20px;">Hesap Bilgileri</span>
                                                                <div class="row">
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label for="cbanka">Banka Adı</label>
                                                                            <input onkeypress="guncelleGoster()" type="text" maxlength="11" class="form-control mb-4" name="cbanka" id="cbanka" placeholder="Banka Adı" value="{{$kullanici->cbanka}}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label for="ciban">IBAN</label>
                                                                            <input onkeypress="guncelleGoster()" type="text" maxlength="26"  class="form-control mb-4" name="ciban" id="ciban" placeholder="IBAN" value="{{$kullanici->ciban}}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="form-group">
                                                                            <label for="chesapno">Hesap No</label>
                                                                            <input onkeypress="guncelleGoster()" type="text" maxlength="26"  class="form-control mb-4" name="chesapno" id="chesapno" placeholder="Hesap Numarası" value={{$kullanici->chesapno}}>
                                                                        </div>
                                                                    </div>   
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="account-settings-footer justify-content-center fixed-bottom hide d-none">
                                                    <div class="as-footer-container text-center justify-content-center">
                                                        <button type="submit" id="multiple-messages" class="btn btn-primary">Güncelle</button>
                                                    </div> 
                                                  </div>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- Çalışan Güncelleme Kısmı -->
                                    <!-- Müşteri Güncelleme Kısmı -->
                                    @else 
                                        <div class="row">
                                            <div class="col-3">
                                                <div class="profilepic" style="border-radius: 20%;">
                                                    <img class="profilepic__image" alt="Profil Resmi"
                                                        src="{{ $musteri->mphoto }}" />
                                                    <div class="profilepic__content">
                                                        <span class="profilepic__icon"><i class="fas fa-camera"></i></span>
                                                        <form method="post" action="{{ route('uploadPP', ["tip" => "Müşteri"]) }}"
                                                            enctype="multipart/form-data">
                                                            @csrf
                                                            <input type="file" id="actual-btn" name="photo"
                                                             onchange="javascript:document.getElementById('upload_button').hidden = false;" hidden />
                                                            <label for="actual-btn" class="profilepic__text"> Fotoğrafı Düzenle</label>
                                                        
                                                    </div>
    
                                                </div>
                                                <div id="upload_button_div"><button type="submit" id="upload_button" hidden>Yükle</button></div>
                                            </form>
                                            </div>
    
                                            <div class="col-9 px-4">
                                                <form id="kisiBilgileri" class="section contact" method="post" action="{{route('musteri.guncelle.profil',["mtcknvno" => $musteri->mtcknvno])}}" >
                                                    @csrf
                                                    @method("put")
                                                    <div class="info bg-light">
                                                        <div class="row">
                                                            <div class="col-md-11 mx-auto text-center">
                                                                <span class="badge badge-primary font-weight-bold w-100 mb-2" style="font-size:20px;">Kişisel Bilgiler</span>
                                                                    <div class="row pb-2">
                                                                        <div class="col-md-3">
                                                                            <div class="form-group input field-wrapper">
                                                                                <label for="ad">Ad</label>
                                                                                <input onkeypress="guncelleGoster()" type="text" class="form-control mb-4"  name="mbadi"  value="{{$musteri->mbadi}}" required>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-2">
                                                                            <div class="form-group">
                                                                                <label for="soyad">Soyad</label>
                                                                                <input onkeypress="guncelleGoster()" type="text" class="form-control mb-4" name="mbsoyadi"   value="{{$musteri->mbsoyadi}}" required>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-2">
                                                                            <div class="form-group">
                                                                                <label for="tckn">TCKN</label>
                                                                                <input onkeypress="guncelleGoster()" type="text" class="form-control mb-4" name="mtcknvno" onkeypress='return event.charCode >= 48 && event.charCode <= 57' value="{{$musteri->mtcknvno}}" readonly>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-3">
                                                                            <div class="form-group">
                                                                                <label for="website1">Ünvan</label>
                                                                                <input onkeypress="guncelleGoster()" type="text" class="form-control mb-4" name="mbunvani" id="website1" placeholder="Ünvan" value="{{$musteri->mbunvani}}" required>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-2">
                                                                            <div class="form-group">
                                                                                <label for="dg">Doğum Günü</label>
                                                                                <input onkeypress="guncelleGoster()" type="date" class="form-control mb-4"  name="mbdogumgunu" id="dogumgunu" value="{{$musteri->mbdogumgunu}}" required>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <span class="badge badge-primary font-weight-bold w-100 mb-2" style="font-size:20px;">İletişim Bilgileri</span>
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label for="phone">Telefon Numarası</label>
                                                                                <input onkeypress="guncelleGoster()" type="text" maxlength="15" class="form-control mb-4" onkeypress='return event.charCode >= 48 && event.charCode <= 57' name="mtel" id="telefon_musteri" placeholder="Telefon Numarası" value="{{$musteri->mtel}}" required>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label for="email">Eposta</label>
                                                                                <input onkeypress="guncelleGoster()" type="text" class="form-control mb-4" name="meposta" id="meposta" placeholder="Eposta" value="{{$musteri->meposta}}" required>
                                                                            </div>
                                                                        </div>
                                                                    </div> 
                                                                    <span class="badge badge-primary font-weight-bold w-100 mb-2" style="font-size:20px;">Adres Bilgileri</span>
                                                                    <div class="row">
                                                                        <div role="button" id="anlikKonum" class="btn btn-light"><svg
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                            xmlns:xlink="http://www.w3.org/1999/xlink" fill="#de1717"
                                                                            version="1.1" id="Capa_1" width="800px" height="800px"
                                                                            viewBox="0 0 395.71 395.71" xml:space="preserve" stroke="#006eff">
                                                                            <g id="SVGRepo_bgCarrier" stroke-width="0" />
                                                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                                                stroke-linejoin="round" />
                                                                            <g id="SVGRepo_iconCarrier">
                                                                                <g>
                                                                                    <path d="M197.849,0C122.131,0,60.531,61.609,60.531,137.329c0,72.887,124.591,243.177,129.896,250.388l4.951,6.738 c0.579,0.792,1.501,1.255,2.471,1.255c0.985,0,1.901-0.463,2.486-1.255l4.948-6.738c5.308-7.211,129.896-177.501,129.896-250.388 C335.179,61.609,273.569,0,197.849,0z M197.849,88.138c27.13,0,49.191,22.062,49.191,49.191c0,27.115-22.062,49.191-49.191,49.191 c-27.114,0-49.191-22.076-49.191-49.191C148.658,110.2,170.734,88.138,197.849,88.138z" />
                                                                                </g>
                                                                            </g>
                                                                            </svg>
                                                                        </div>
                                                                        <div class="col-12">
                                                                            <div class="col-1">
                                                                                <input id="hk-enlem" type="hidden" name="menlem" placeholder="Enlem"
                                                                                    value="{{$musteri->menlem}}">
                                                                            </div>
                                                                            <div class="col-1">
                                                                                <input id="hk-boylam" type="hidden" name="mboylam" placeholder="Boylam"
                                                                                    value="{{ $musteri->mboylam }}">
                                                                            </div>
                                                                            <div class="col-12" onclick="guncelleGoster()" id="map">
                                                                                <!-- GOOGLE HARİTALAR -->
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">                                   
                                                                        <div class="col-md-3">
                                                                            <div class="form-group">
                                                                                <label for="location">İl</label>
                                                                                <select onchange="guncelleGoster()" id="mil" name="mil" class="placeholder js-states form-control">
                                                                                    <option>{{$musteri->mil}}</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-3">
                                                                            <div class="form-group">
                                                                                <label for="location">İlçe</label>
                                                                                <select onchange="guncelleGoster()" id="milce" name="milce" class="placeholder js-states form-control">
                                                                                    <option value="{{$musteri->milce}}" selected>{{$musteri->milce}}</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="form-group">
                                                                                <label for="location">Adres</label>
                                                                                <textarea onkeypress="guncelleGoster()" class="form-control mb-4" style="resize:none;" id="madres" name="madres" placeholder="Adres" rows="2">{{$musteri->madres}}</textarea>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <span class="badge badge-primary font-weight-bold w-100 mb-2" style="font-size:20px;">Hesap Bilgileri</span>
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label for="mbankaadi">Banka Adı</label>
                                                                                <input onkeypress="guncelleGoster()" type="text" class="form-control mb-4" name="mbankaadi" id="mbankaadi" placeholder="Banka Adı" value="{{$musteri->mbankaadi}}">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label for="miban">IBAN</label>
                                                                                <input onkeypress="guncelleGoster()" type="text" maxlength="26"  class="form-control mb-4" name="miban" id="miban" placeholder="IBAN" value="{{$musteri->miban}}">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label for="chesapno">Hesap No</label>
                                                                                <input onkeypress="guncelleGoster()" type="text" maxlength="26"  class="form-control mb-4" name="chesapno" id="chesapno" placeholder="Hesap Numarası" value={{$musteri->chesapno}}>
                                                                            </div>
                                                                        </div>   
                                                                    </div>
                                                                    <span class="badge badge-primary font-weight-bold w-100 mb-2" style="font-size:20px;">Firma Bilgileri</span>
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label for="Müşteri Türü">Müşteri Türü</label>
                                                                                <select class="form-control form-control text-center"
                                                                                    name="mkayitturu" id="hk-kayitturu"
                                                                                    onchange="guncelleGoster()" value="{{$musteri->mkayitturu}}">
                                                                                    <option value="Kayıt Türü">Kayıt Türü</option>
                                                                                    <option value="Bireysel">Bireysel</option>
                                                                                    <option value="Ticari">Ticari</option>
                                                                                    <option value="Tedarikçi">Tedarikçi</option>
                                                                                    <option value="Müşteri Adayı">Müşteri Adayı</option>
                                                                                    <option value="Diğer">Diğer</option>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label for="firmaismi">Firma Adı</label>
                                                                                <input onkeypress="guncelleGoster()" type="text" class="form-control mb-4" name="mbfirmaadi" id="mbfirmaadi" placeholder="Firma Adı" value="{{$musteri->mbfirmaadi}}">
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label for="mweb">Web Adresi</label>
                                                                                <input onkeypress="guncelleGoster()" type="text" class="form-control mb-4" name="mweb" id="mweb" placeholder="Firma Adı" value="{{$musteri->mweb}}">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <div class="form-group">
                                                                                <label for="faks">Faks</label>
                                                                                <input onkeypress="guncelleGoster()" type="text" class="form-control mb-4" name="mweb" id="mweb" placeholder="Firma Adı" value="{{$musteri->mfaks}}">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="account-settings-footer justify-content-center fixed-bottom hide d-none">
                                                        <div class="as-footer-container text-center justify-content-center">
                                                            <button type="submit" id="multiple-messages" class="btn btn-primary">Güncelle</button>
                                                        </div> 
                                                      </div>
                                                </form>
                                            </div>
                                        </div>
                                    @endif
                                    <!-- Müşteri Güncelleme Kısmı -->
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- CONTENT AREA -->

                </div>
                <!--<x-footer/>-->
            </div>
            <!--  END CONTENT AREA  -->

        </div>
        <!-- END MAIN CONTAINER -->

        <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
        <x-global-mandatory.scripts />
        <script src="{{ asset('assets/js/il-ilce-secme.js') }}"></script>
        <script src="{{ asset('assets/js/inputController.js') }}"></script>
        <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC7rnOaEVELsqt70bjd2up_KCHbg2RRnCk&callback=initMap" type="text/javascript"></script>
        <script src="https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/js/intlTelInput.min.js"></script>
        <script> // GOOGLE HARİTALAR
            function enlemBoylamDegis(enlem,boylam){
              $("#hk-enlem").attr("value",enlem);
              $("#hk-boylam").attr("value",boylam);    
            }
          
              function initMap() {
               var enlem = document.getElementById("hk-enlem").value;
               var boylam = document.getElementById("hk-boylam").value;
            const myLatlng = { lat: parseFloat(enlem), lng: parseFloat(boylam) };
          
            const map = new google.maps.Map(document.getElementById('map'), {
              zoom: 7,
              center: myLatlng,
            });
          
            let marker = new google.maps.Marker({
              position: myLatlng,
              map,
              title: "KONUM",
              });
    
              const locationButton = document.getElementById("anlikKonum");
    
      locationButton.classList.add("custom-map-control-button");
      map.controls[google.maps.ControlPosition.TOP_CENTER].push(locationButton);
      locationButton.addEventListener("click", () => {
    
        marker.setMap(null); // marker'ı sıfırlar
        // Try HTML5 geolocation.
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(
            (position) => {
              const pos = {
                lat: position.coords.latitude,
                lng: position.coords.longitude,
              };
              marker = new google.maps.Marker({ // tıklanan konuma marker yerleştirir
                position: pos,
              });
    
              enlemBoylamDegis(pos.lat,pos.lng); // enlem ve boylam bilgilerini inputa verir.
              marker.setMap(map);
              map.setCenter(pos);
            }
          );
        }
      });
          
            // Configure the click listener.
            map.addListener("click", (mapsMouseEvent) => {
              // Close the current InfoWindow.
              marker.setMap(null); // marker'ı sıfırlar
              marker = new google.maps.Marker({ // tıklanan konuma marker yerleştirir
                position: mapsMouseEvent.latLng,
              });
          
              var lat = JSON.stringify(mapsMouseEvent.latLng.toJSON().lat); // Seçilen konumun lat bilgisini alır.
              var lng = JSON.stringify(mapsMouseEvent.latLng.toJSON().lng); // Seçilen konumun lng bilgisini alır. 
              enlemBoylamDegis(lat,lng); // enlem ve boylam bilgilerini inputa verir.
              marker.setMap(map);
            });
            }
            </script>

    <script>
        var musteriTelefon = document.querySelector("#telefon_musteri");
        var musteriTelefonHandler = window.intlTelInput(musteriTelefon, {
            utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/js/utils.js",
            setCountry: "tr",
            initialCountry: "tr",
            preferredCountries: ["tr", "us", "gb"],
            separateDialCode: true,
            nationalMode: false,
        });

        musteriTelefon.addEventListener("change", function() {
            this.value = musteriTelefonHandler.getNumber();
        });

        var calisanTelefon = document.querySelector("#telefon_calisan");
        var calisanTelefonHandler = window.intlTelInput(calisanTelefon, {
            utilsScript: "https://cdn.jsdelivr.net/npm/intl-tel-input@18.1.1/build/js/utils.js",
            setCountry: "tr",
            initialCountry: "tr",
            preferredCountries: ["tr", "us", "gb"],
            separateDialCode: true,
            nationalMode: false,
        });

        calisanTelefon.addEventListener("change", function() {
            this.value = calisanTelefonHandler.getNumber();
        });
    </script>
</body>

</html>
