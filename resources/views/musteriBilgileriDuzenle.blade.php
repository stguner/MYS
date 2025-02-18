<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>MYS - MÜŞTERİ YÖNETİMİ</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon.ico') }}"/>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <x-global-mandatory.styles/>
    <!-- END GLOBAL MANDATORY STYLES -->
    
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <link href="{{ asset('assets/css/scrollspyNav.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/jquery-step/jquery.steps.css') }}">
    <style>
        #formValidate .wizard > .content {min-height: 25em;}
        #example-vertical.wizard > .content {min-height: 24.5em;}

              /* Chrome, Safari, Edge, Opera */
      input::-webkit-outer-spin-button,
      input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
      }

      /* Firefox */
      input[type=number] {
        -moz-appearance: textfield;
      }

    </style>
    <style>
        #map {
          height: 300px;
          width: 100%;
         }
      </style>
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/dropify/dropify.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/users/account-setting.css') }}"/>

    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    
</head>
<body class="sidebar-noneoverflow">
    <!--  BEGIN NAVBAR  -->
    <x-topbar/>
    <!--  END NAVBAR  -->

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">

        <div class="overlay"></div>
        <div class="search-overlay"></div>

        <!--  BEGIN TOPBAR  -->
        <x-navbar/>
        <!--  END TOPBAR  -->
        
        <!--  BEGIN CONTENT AREA  -->  
        <div id="content" class="main-content">
            <div class="layout-px-spacing">
              <div class="layout-px-spacing">
                <div class="page-header">
                  <nav class="breadcrumb-one" aria-label="breadcrumb">
                      <ol class="breadcrumb">
                          <li class="breadcrumb-item"><a href="javascript:void(0);" style="color:whitesmoke">MYS</a></li>
                          <li class="breadcrumb-item"><a href="javascript:void(0);" style="color:whitesmoke">Müşteri Yönetimi</a></li>
                          <li class="breadcrumb-item"><a href="javascript:void(0);" style="color:whitesmoke">Müşteri Bilgileri Düzenleme</a></li>
                      </ol>
                  </nav>
              </div>
                <!-- CONTENT AREA -->
                <div class="row">
                    <div class="col-xl-12 col-lg-12 col-md-12 col-12 layout-top-spacing layout-spacing">
                        <div class="widget widget-content-area br-4">
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach($errors->all() as $error)
                    <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if(Session::has("success"))
            <div class="alert alert-success">
                {{Session::get("success")}}
            </div>
        @endif
        @if(Session::has("calisanKayitli"))
            <div class="alert alert-danger">
                {{Session::get("calisanKayitli")}}
            </div>
        @endif
                            <div class="widget-one"> 
                                <div class="col-xl-12 col-lg-12 col-md-12 layout-spacing">
                                    <form id="kisiBilgileri" class="section contact p-4" method="post" action="{{route('musteri.guncelle',["mtcknvno" => $musteri->mtcknvno])}}">
                                        @csrf
                                        @method("PUT")
                                        <div id="example-basic">
                                            <h3>Ticari Bilgiler</h3>
                                            <section>
                                              <div class="row py-3">
                                                    <div class="col-3">
                                                        <label for="email">Kayıt Türü</label>
                                                        <select class="form-control" name="mkayitturu" id="hk-kayitturu" onchange="guncelleGoster()" onchange="changeFieldsMusteri(this.value)">
                                                        <option value="Kayıt Türü">Kayıt Türü</option>
                                                        <option value="Bireysel" {{ $musteri->mkayitturu == 'Bireysel' ? 'selected' : '' }}>Bireysel</option>
                                                        <option value="Ticari" {{ $musteri->mkayitturu == 'Ticari' ? 'selected' : '' }}>Ticari</option>
                                                        <option value="Tedarikçi" {{ $musteri->mkayitturu == 'Tedarikçi' ? 'selected' : '' }}>Tedarikçi</option>
                                                        <option value="Müşteri Adayı" {{ $musteri->mkayitturu == 'Müşteri Adayı' ? 'selected' : '' }}>Müşteri Adayı</option>
                                                        <option value="Diğer" {{ $musteri->mkayitturu == 'Diğer' ? 'selected' : '' }}>Diğer</option>
                                                    </select>
                                                    </div>
                                                    <div class="col-3">
                                                        <label for="email">Müşteri Türü</label>
                                                        <select class="form-control" name="mturu" onchange="guncelleGoster()" id="hk-mturu">
                                                            <option value="Gerçek" {{ $musteri->mturu == 'Gerçek' ? 'selected' : '' }}>Gerçek Kişi</option>
                                                            <option value="Tüzel" {{ $musteri->mturu == 'Tüzel' ? 'selected' : '' }}>Tüzel Kişi</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-3">
                                                        <label for="email">TCKN</label>
                                                        <input id="hk-tcknvno" type="number" name="mtcknvno" onchange="guncelleGoster()" placeholder="TCKN/Vergi No" value="{{ $musteri->mtcknvno }}" class="form-control">
                                                    </div>
                                                    <div class="col-3 bireyselbilgi">
                                                        <label for="email">Firma Adı</label>
                                                        <input id="hk-firma" onkeyup="hkCalistigiFirmaBuyuk()" onchange="guncelleGoster()" type="text" name="mbfirmaadi" placeholder="Firma Adı" value="{{ $musteri->mbfirmaadi }}" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="row py-3">
                                                  <div class="col-3 bireyselbilgi">
                                                    <label for="email">Ad</label>
                                                    <input id="hk-ad" type="text" name="mbadi" onkeyup="hkAdilkHarfBuyuk()" onchange="guncelleGoster()" placeholder="Adı" value="{{ $musteri->mbadi }}" class="form-control">
                                                  </div>
                                                  <div class="col-3 bireyselbilgi">
                                                    <label for="email">Soyad</label>
                                                        <input id="hk-soyad" type="text" onkeyup="hkSoyadBuyuk()" onchange="guncelleGoster()" name="mbsoyadi" placeholder="Soyadı" value="{{ $musteri->mbsoyadi }}" class="form-control">
                                                  </div>
                                                  <div class="col-3 bireyselbilgi">
                                                    <label for="email">Ünvan</label>
                                                        <input id="hk-unvan" type="text" onkeyup="hkUnvanBuyuk()" onchange="guncelleGoster()" name="mbunvani" placeholder="Unvanı/Mesleği" value="{{ $musteri->mbunvani }}" class="form-control">
                                                  </div> 
                                                  <div class="col-3 bireyselbilgi">
                                                    <label for="email">Doğum Günü</label>
                                                    <input id="hk-dogum" type="text" name="mbdogumgunu" onchange="guncelleGoster()" placeholder="Doğum Tarihi" value="{{ date('d.m.Y', strtotime($musteri->mbdogumgunu)) }}" class="form-control" onfocus="(this.type='date')">
                                                  </div>  
                                                </div> 
                                                                 
                                            </section>
                                            <h3>Banka ve İletişim Bilgileri</h3>
                                            <section>
                                                <div class="row py-3">
                                                    <div class="col-3">
                                                        <label for="email">Banka Adı</label>
                                                        <input id="hk-banka" onkeyup="hkBankaAdiBuyuk()" onchange="guncelleGoster()" type="text" name="mbankadi" placeholder="Banka Adı" value="{{ $musteri->mbankadi }}" class="form-control">
                                                      </div>
                                                      <div class="col-3">
                                                        <label for="email">IBAN</label>
                                                            <input id="hk-iban" type="text" name="miban" onchange="guncelleGoster()" placeholder="IBAN" value="{{ $musteri->miban }}" class="form-control">
                                                      </div>  
                                                <div class="col-3">
                                                    <label for="email">Telefon Numarası</label>
                                                    <div class="form-group">
                                                        <input id="hk-mtel" name="mtel" input="text" onchange="guncelleGoster()" placeholder="Telefon" value="{{ $musteri->mtel }}" class="form-control">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row py-3">
                                                <div class="col-3">
                                                    <label for="email">Eposta</label>
                                                    <input id="hk-eposta" type="email" name="meposta" onchange="guncelleGoster()" placeholder="E-Posta" value="{{ $musteri->meposta }}" class="form-control">
                                                  </div>
                                                  <div class="col-3">
                                                    <label for="email">Web Sitesi</label>
                                                    <input id="hk-website" type="text" name="mweb" onchange="guncelleGoster()" placeholder="Web Site" value="{{ $musteri->mweb }}" class="form-control">
                                                  </div>  
                                                  <div class="col-3">
                                                    <label for="email">Faks</label>
                                                    <input id="hk-fax" type="text" name="mfaks" onchange="guncelleGoster()" placeholder="Faks" value="{{ $musteri->mfaks }}" class="form-control">
                                                  </div>
                                                </div>

                                            </section>
                                            <h3>Adres Bilgileri</h3>
                                            <section>
                                                <div class="row py-3">
                                                    <div class="col-md-6">Adres
                                                        <label for="email">Eposta</label>
                                                        <div class="form-group">
                                                            <textarea class="form-control mb-4" onkeypress="guncelleGoster()" onkeyup="madresBuyuk()" id="madres" name="madres" placeholder="Adres" rows="2">{{ $musteri->madres }}</textarea>
                                                        </div>
                                                    </div>  
                                                    
                                                    <div class="col-md-6">
                                                        <label for="email">Not</label>
                                                        <div class="form-group">
                                                            <textarea class="form-control mb-4" onkeypress="guncelleGoster()" id="mnot" name="mnot" placeholder="Notlar" rows="2">{{ $musteri->mnot }}</textarea>
                                                        </div>
                                                    </div>  
                                                </div> 
                                                <div class="row py-3">
                                                    <div class="col-2">
                                                        <label for="email">Bölge</label>
                                                        <input id="hk-bolge" onkeypress="guncelleGoster()" type="text" onkeyup="hkBolgeBuyuk()" name="mbolge" placeholder="Bölge" value="{{ $musteri->mbolge }}" class="form-control">
                                                      </div>  
                                                      <div class="col-2">
                                                        <label for="email">İl</label>
                                                        <select id="Iller" onchange="guncelleGoster()" name="mil" class="placeholder js-states form-control">
                                                          <option>{{ $musteri->mil }}</option>
                                                        </select>
                                                      </div>  
                                                      <div class="col-2">
                                                        <label for="email">İlçe</label>
                                                        <select id="Ilceler" onchange="guncelleGoster()" name="milce" class="placeholder js-states form-control">
                                                          <option>{{ $musteri->milce }}</option>
                                                        </select>
                                                      </div>
                                                      <div class="col-3">
                                                        <input id="hk-enlem" type="hidden" name="menlem" placeholder="Enlem" value="{{ $musteri->menlem }}" class="form-control">
                                                      </div>  
                                                      <div class="col-3">
                                                        <input id="hk-boylam" type="hidden" name="mboylam" placeholder="Boylam" value="{{ $musteri->mboylam }}" class="form-control">
                                                      </div>
                                                </div> 
                                                <div role="button" id="anlikKonum" class="btn btn-light"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="#de1717" version="1.1" id="Capa_1" width="800px" height="800px" viewBox="0 0 395.71 395.71" xml:space="preserve" stroke="#006eff"><g id="SVGRepo_bgCarrier" stroke-width="0"/><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"/><g id="SVGRepo_iconCarrier"> <g> <path d="M197.849,0C122.131,0,60.531,61.609,60.531,137.329c0,72.887,124.591,243.177,129.896,250.388l4.951,6.738 c0.579,0.792,1.501,1.255,2.471,1.255c0.985,0,1.901-0.463,2.486-1.255l4.948-6.738c5.308-7.211,129.896-177.501,129.896-250.388 C335.179,61.609,273.569,0,197.849,0z M197.849,88.138c27.13,0,49.191,22.062,49.191,49.191c0,27.115-22.062,49.191-49.191,49.191 c-27.114,0-49.191-22.076-49.191-49.191C148.658,110.2,170.734,88.138,197.849,88.138z"/> </g> </g></svg>                            
                                                </div>
                                                <div class="py-3 row">
                                                    <div class="col-12" onclick="guncelleGoster()" id="map"> </div><!-- GOOGLE HARİTALAR -->
                                                </div>
                                            </section>
                                            
                                        </div>
                                        <div class="account-settings-footer justify-content-center fixed-bottom hide d-none">
                                          <div class="as-footer-container text-center justify-content-center">
                                              <button type="submit" id="multiple-messages" class="btn btn-primary">Güncelle</button>
                                          </div> 
                                        </div>
                                    </form>
                                </div>
                               

                                
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
    <script>
        // GOOGLE HARİTALAR
        function enlemBoylamDegis(enlem, boylam) {
            $("#hk-enlem").attr("value", enlem);
            $("#hk-boylam").attr("value", boylam);
        }
    
        function initMap() {
            var enlem = document.getElementById("hk-enlem").value;
            var boylam = document.getElementById("hk-boylam").value;
            const myLatlng = {
                lat: parseFloat(enlem),
                lng: parseFloat(boylam)
            };
    
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
    
                            enlemBoylamDegis(pos.lat, pos.lng); // enlem ve boylam bilgilerini inputa verir.
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
                var lng = JSON.stringify(mapsMouseEvent.latLng.toJSON()
                    .lng); // Seçilen konumun lng bilgisini alır. 
                enlemBoylamDegis(lat, lng); // enlem ve boylam bilgilerini inputa verir.
                marker.setMap(map);
            });
        }
    </script>
    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
   

    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC7rnOaEVELsqt70bjd2up_KCHbg2RRnCk&callback=initMap" type="text/javascript"></script>
    <x-global-mandatory.scripts/>
    <script src="{{ asset('plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
    
    <script>
        $(document).ready(function() {
            App.init();
            $(".ticaribilgi").hide();
        });
    </script>
    <script>
        $(".placeholder").select2({
    placeholder: "Make a Selection",
    allowClear: true
        });
    </script>
    <script src="{{ asset('plugins/highlight/highlight.pack.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    <script src="{{ asset('assets/js/scrollspyNav.js') }}"></script>
    <script src="{{ asset('plugins/jquery-step/jquery.steps.min.js') }}"></script>
    <script src="{{ asset('plugins/jquery-step/custom-jquery.steps.js') }}"></script>
    <script src="{{ asset('assets/js/inputController.js') }}"></script>
    <script src="{{ asset('assets/js/kisiBilgileri.js') }}"></script>
    <script src="{{ asset('assets/js/il-ilce-guncelleme.js') }}"></script>
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
</body>
</html>