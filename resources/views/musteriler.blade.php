<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" />
  <title>MYS - MÜŞTERİLER</title>
  <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon.ico') }}" />
  <!-- BEGIN GLOBAL MANDATORY STYLES -->
  <x-global-mandatory.styles />
  <!-- END GLOBAL MANDATORY STYLES -->

  <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->

  <style>
    /*
            The below code is for DEMO purpose --- Use it if you are using this demo otherwise Remove it
        */
    /*.navbar .navbar-item.navbar-dropdown {
            margin-left: auto;
        }*/
    .layout-px-spacing {
      min-height: calc(100vh - 170px) !important;
    }
  </style>

  <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->

  <!-- BEGIN PAGE LEVEL CUSTOM STYLES -->
  <link rel="stylesheet" type="text/css" href="{{ asset('plugins/table/datatable/datatables.css') }}" />
  <link rel="stylesheet" type="text/css" href="{{ asset('plugins/table/datatable/custom_dt_html5.css') }}" />
  <link rel="stylesheet" type="text/css" href="{{ asset('plugins/table/datatable/dt-global_style.css') }}" />

  <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/forms/theme-checkbox-radio.css') }}" />
  <link href="{{ asset('plugins/jquery-ui/jquery-ui.min.css') }}" rel="stylesheet" type="text/css" />
  <link href="{{ asset('assets/css/apps/contacts.css') }}" rel="stylesheet" type="text/css" />
  <!-- END PAGE LEVEL CUSTOM STYLES -->
  <!--  BEGIN CUSTOM STYLE FILE  -->
  <link href="assets/css/scrollspyNav.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" type="text/css" href="plugins/jquery-step/jquery.steps.css">
  <style>
      #formValidate .wizard > .content {min-height: 25em;}
      #example-vertical.wizard > .content {min-height: 24.5em;}
  </style>
  <!--  END CUSTOM STYLE FILE  -->
  <style>
    
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
      <link href="{{ asset('plugins/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet" type="text/css" />
      <link href="assets/css/users/user-profile.css" rel="stylesheet" type="text/css" />
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
      <!-- END GLOBAL MANDATORY STYLES -->
      
  
      <link href="{{ asset('assets/css/apps/invoice-list.css') }}" rel="stylesheet" type="text/css" />
      <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->
      <link rel="stylesheet" type="text/css" href="plugins/bootstrap-select/bootstrap-select.min.css">

      <link href="plugins/flatpickr/flatpickr.css" rel="stylesheet" type="text/css">
      <link href="plugins/flatpickr/custom-flatpickr.css" rel="stylesheet" type="text/css">

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

    <!--  BEGIN CONTENT AREA  -->
    <div id="content" class="main-content widget-content searchable-container list">
      <div class="layout-px-spacing">
        <div class="modal fade" id="addContactModal" tabmys_index="-1" role="dialog"
          aria-labelledby="addContactModalTitle" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
              <div class="modal-body">
                <i class="flaticon-cancel-12 close" data-dismiss="modal"></i>
                <div class="add-contact-box">
                  <div class="add-contact-content">
                    {{-- <form id="addContactModalTitle">
                      <div class="row">
                        <div class="col-md-6">
                          <div class="contact-name">
                            <i class="flaticon-user-11"></i>
                            <input type="text" id="c-name" class="form-control" placeholder="İsim">
                            <span class="validation-text"></span>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="contact-email">
                            <i class="flaticon-mail-26"></i>
                            <input type="text" id="c-email" class="form-control" placeholder="E-posta">
                            <span class="validation-text"></span>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-6">
                          <div class="contact-occupation">
                            <i class="flaticon-fill-area"></i>
                            <input type="text" id="c-occupation" class="form-control" placeholder="Meslek">
                          </div>
                        </div>

                        <div class="col-md-6">
                          <div class="contact-phone">
                            <i class="flaticon-telephone"></i>
                            <input type="text" id="c-phone" class="form-control" placeholder="Telefon Numarası">
                            <span class="validation-text"></span>
                          </div>
                        </div>
                      </div>

                      <div class="row">
                        <div class="col-md-12">
                          <div class="contact-location">
                            <i class="flaticon-location-1"></i>
                            <input type="text" id="c-location" class="form-control" placeholder="Lokasyon">
                          </div>
                        </div>
                      </div>

                    </form> --}}
                    <div class="statbox widget box box-shadow">
                      <div class="widget-header">
                          <div class="row">
                              <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                  <h4>Hızlı Kayıt</h4>
                              </div>
                          </div>
                      </div>
                      <div class="widget-content widget-content-area">
                      <form id="hizlikayit_form">
                          <div id="example-basic">
                              <h3>Ön Bilgiler</h3>
                              <section>
                                <div class="row py-3">
                                <div class="col-6">
                                  <select class="form-control form-control-sm" id="hk-kayitturu" onchange="changeFields(this.value)">
                                    <option value="Kayıt Türü">Kayıt Türü</option>
                                    <option value="Bireysel Müşteri">Bireysel</option>
                                    <option value="Ticari Müşteri">Ticari</option>
                                    <option value="Tedarikçi">Tedarikçi</option>
                                    <option value="Müşteri Adayı">Müşteri Adayı</option>
                                    <option value="Diğer">Diğer</option>
                                  </select>
                                </div>
                                <div class="col-6">
                                    <input id="hk-tcknvno" type="number" name="hk-tcknvno" placeholder="TCKN/Vergi No" class="form-control form-control-sm" required>
                                </div>
                                </div>
                                  <div class="row py-3">

                                    <div class="col">
                                      <input id="hk-marka" type="text" name="hk-marka" placeholder="Marka Adı" class="form-control form-control-sm" required>
                                    </div>
                                  </div>

                                  <div class="row py-3">                                    
                                    <div class="col">
                                      <input id="hk-ad" type="text" name="hk-ad" placeholder="Adı" class="form-control form-control-sm" required>
                                    </div>
                                    
                                    <div class="col">
                                      <input id="hk-soyad" type="text" name="hk-soyad" placeholder="Soyadı" class="form-control form-control-sm" required>
                                    </div>
                                  </div>

                                  <div class="row py-3">                                   
                                    <div class="col">
                                      <input id="hk-unvan" type="text" name="hk-unvan" placeholder="Unvanı" class="form-control form-control-sm">
                                    </div>
                                    
                                    <div class="col">
                                      <input id="basicFlatpickr" value="" class="form-control form-control-sm flatpickr flatpickr-input active" type="text" placeholder="Doğum Günü">
                                    </div>
                                  </div>


                              </section>
                              <h3>İletişim</h3>
                              <section>
                                <div class="form-group mb-4">
                                  <textarea placeholder="Adres" class="form-control" name="hk-adres" id="hk-adres" rows="3"></textarea>
                              </div>

                              <div class="row">
                                <div class="col-4">
                                  <input id="hk-bolge" type="text" name="hk-bolge" placeholder="Bölge" class="form-control form-control-sm" required>
                                </div>
                                <div class="col-4">
                                  <input id="hk-ilce" type="text" name="hk-ilce" placeholder="İlçe" class="form-control form-control-sm" required>
                                </div>
                                <div class="col-4">
                                  <input id="hk-il" type="text" name="hk-il" placeholder="İl" class="form-control form-control-sm" required>
                                </div>
                              </div>

                              <div class="row py-3">
                                <div class="col-6">
                                  <input id="ph-number" type="text" name="hk-mobil" placeholder="Mobil" class="form-control form-control-sm" required>
                                </div>
                                <div class="col-3">
                                  <input id="hk-enlem" type="text" name="hk-enlem" placeholder="Enlem" class="form-control form-control-sm" required>
                                </div>
                                <div class="col-3">
                                  <input id="hk-boylam" type="text" name="hk-boylam" placeholder="Boylam" class="form-control form-control-sm" required>
                                </div>
                              </div>
                              </section>
                          </div>
                      </form>
                      </div>
                  </div>
                  </div>
                </div>
              </div>
              <div class="modal-footer">
                <button id="btn-edit" class="float-left btn">Kaydet</button>

                <button class="btn" data-dismiss="modal"> <i class="flaticon-delete-1"></i> İptal Et</button>

                <button id="btn-add" class="btn">Ekle</button>
              </div>
            </div>
          </div>
        </div>

        <!-- Gozat Modal -->
<div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

          <div class="user-profile layout-spacing shadow">
              <div class="widget-content widget-content-area">
                  <div class="text-center user-info">
                      <p class="" id="modal-isim">Jimmy Turner</p>
                      <span id="modal-unvan" class="text-muted">Web Developer</span>
                  </div>
                  <div class="user-info-list">

                      <div class="">
                          <ul class="contacts-block list-unstyled">
                              <li class="contacts-block__item">
                                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-calendar"><rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect><line x1="16" y1="2" x2="16" y2="6"></line><line x1="8" y1="2" x2="8" y2="6"></line><line x1="3" y1="10" x2="21" y2="10"></line></svg><span id="modal-dogum">Jan 20, 1989</span>
                              </li>
                              <li class="contacts-block__item">
                                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-map-pin"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg><span id="modal-lokasyon">New York, USA</span>
                              </li>
                              <li class="contacts-block__item">
                                  <a href="mailto:example@mail.com"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-mail"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path><polyline points="22,6 12,13 2,6"></polyline></svg><span id="modal-eposta">Jimmy@gmail.com</span></a>
                              </li>
                              <li class="contacts-block__item">
                                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-phone"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg><span id="modal-cep"> +1 (530) 555-12121</span>
                              </li>
                              <li class="contacts-block__item">
                                  <ul class="list-inline">
                                      <li class="list-inline-item">
                                          <div class="social-icon">
                                              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-facebook"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path></svg>
                                          </div>
                                      </li>
                                      <li class="list-inline-item">
                                          <div class="social-icon">
                                              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-twitter"><path d="M23 3a10.9 10.9 0 0 1-3.14 1.53 4.48 4.48 0 0 0-7.86 3v1A10.66 10.66 0 0 1 3 4s-4 9 5 13a11.64 11.64 0 0 1-7 2c9 5 20 0 20-11.5a4.5 4.5 0 0 0-.08-.83A7.72 7.72 0 0 0 23 3z"></path></svg>
                                          </div>
                                      </li>
                                      <li class="list-inline-item">
                                          <div class="social-icon">
                                              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-linkedin"><path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path><rect x="2" y="9" width="4" height="12"></rect><circle cx="4" cy="4" r="2"></circle></svg>
                                          </div>
                                      </li>
                                  </ul>
                              </li>
                          </ul>
                      </div>                                    
                  </div>
              </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
      </div>
    </div>
  </div>
</div>
        <!-- CONTENT AREA -->
        <div class="row">
          <div class="col-xl-12 col-lg-12 col-md-12 col-12 layout-top-spacing layout-spacing">
            <div class="widget widget-content-area br-4">
              <!-- <div class="widget-one">
                  <h6>BURASI MÜŞTERİLER SAYFASI OLACAK</h6>
                </div> -->
              <div class="widget-two">
                <table id="html5-extension" class="table table-hover non-hover" style="width: 100%">
                  <thead>
                    <tr>
                      <th>Kayıt Türü</th>
                      <th>Firma</th>
                      <th>Yetkili İsmi</th>
                      <th>TCKN/Vergi No</th>
                      <th>Lokasyon</th>
                      {{-- <th>Müşteri Kayıt Tarihi</th> --}}
                      <th>İletişim</th>
                      <th class="dt-no-sorting">İşlemler</th>
                    </tr>
                  </thead>
                  <tbody>

                    @unless(count($musteriler) == 0)
                      @foreach ($musteriler as $musteri)
                        <x-musteri :musteri="$musteri" />
                      @endforeach
                    @endunless
                    
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
        <!-- CONTENT AREA -->
      </div>
      <x-footer />
    </div>
    <!--  END CONTENT AREA  -->
  </div>
  <!-- END MAIN CONTAINER -->

  <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
  <x-global-mandatory.scripts/>
  <script src="{{ asset('plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
  <script src="{{ asset('assets/js/app.js') }}"></script>

  <script>
    $(document).ready(function () {
      App.init();
    });
  </script>
  <script src="plugins/highlight/highlight.pack.js"></script>
  <script src="{{ asset('assets/js/custom.js') }}"></script>
  <!-- END GLOBAL MANDATORY SCRIPTS -->



  <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
  <script src="assets/js/scrollspyNav.js"></script>
  <script src="plugins/jquery-step/jquery.steps.min.js"></script>
  <script src="plugins/jquery-step/custom-jquery.steps.js"></script>
  <script src="{{ asset('assets/js/users/account-settings.js') }}"></script>
  <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
  <script src="plugins/input-mask/jquery.inputmask.bundle.min.js"></script>
  <script src="plugins/input-mask/input-mask.js"></script>

  <script src="{{ asset('assets/js/apps/invoice-list.js') }}"></script>

  <script src="{{ asset('plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
  <script src="{{ asset('assets/js/app.js') }}"></script>
  
  <script>
      $(document).ready(function() {
          App.init();
      });
  </script>
  <script src="{{ asset('assets/js/custom.js') }}"></script>
  <!-- END GLOBAL MANDATORY SCRIPTS -->

  <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
  <script src="{{ asset('plugins/table/datatable/datatables.js') }}"></script>
  <script src="{{ asset('assets/js/apps/invoice-list.js') }}"></script>
  <script src="{{ asset('assets/js/kisiBilgileri.js') }}"></script>
  <!-- END PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->

  <script src="{{ asset('assets/js/kisiBilgileri.js') }}"></script>

<!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
<!-- NOTE TO Use Copy CSV Excel PDF Print Options You Must Include These Files  -->
<script src="{{ asset('plugins/table/datatable/button-ext/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('plugins/table/datatable/button-ext/jszip.min.js') }}"></script>
<script src="{{ asset('plugins/table/datatable/button-ext/buttons.html5.min.js') }}"></script>
<script src="{{ asset('plugins/table/datatable/button-ext/buttons.print.min.js') }}"></script>

<script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<script src="{{ asset('assets/js/apps/contact.js') }}"></script>

<script src="plugins/bootstrap-select/bootstrap-select.min.js"></script>
<script src="plugins/flatpickr/flatpickr.js"></script>
<script src="plugins/flatpickr/custom-flatpickr.js"></script>


  <script>
    $("#html5-extension").DataTable({
      dom:
        "<'dt--top-section'<'row'<'col-sm-12 col-md-6 d-flex justify-content-md-start justify-content-center'B><'col-sm-12 col-md-6 d-flex justify-content-md-end justify-content-center mt-md-0 mt-3'f>>>" +
        "<'table-responsive'tr>" +
        "<'dt--bottom-section d-sm-flex justify-content-sm-between text-center'<'dt--pages-count  mb-sm-0 mb-3'i><'dt--pagination'p>>",
      buttons: {
        buttons: [
          { extend: "excel", className: "btn btn-sm" },
        ],
      },
      oLanguage: {
        oPaginate: {
          sPrevious:
            '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left"><line x1="19" y1="12" x2="5" y2="12"></line><polyline points="12 19 5 12 12 5"></polyline></svg>',
          sNext:
            '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right"><line x1="5" y1="12" x2="19" y2="12"></line><polyline points="12 5 19 12 12 19"></polyline></svg>',
        },
        sInfo: "_PAGE_ / _PAGES_",
        sSearch:
          '<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>',
        sSearchPlaceholder: "Ara...",
        sLengthMenu: "Sonuçlar :  _MENU_",
      },
      stripeClasses: [],
      lengthMenu: [7, 10, 20, 50],
      pageLength: 7,
    });

    let top_section = document.getElementsByClassName("dt--top-section");
    let my_element =
      "<a href='/musteri_ekle' role='button'><svg id='btn-add-contact' xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='currentColor' stroke-width='2' stroke-linecap='round' stroke-linejoin='round' class='feather feather-user-plus'><path d='M16 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2'></path><circle cx='8.5' cy='7' r='4'></circle><line x1='20' y1='8' x2='20' y2='14'></line><line x1='23' y1='11' x2='17' y2='11'></line></svg></a>";
    let desired_place = top_section[0].children[0].children[1].children;

    function htmlToElement(html) {
      var template = document.createElement("template");
      html = html.trim(); // Never return a text node of whitespace as the result
      template.innerHTML = html;
      return template.content.firstChild;
    }
    my_element = htmlToElement(my_element);
    desired_place[0].parentNode.insertBefore(my_element, desired_place[0]);

    let new_element = "<button id='btn-add-hizlikayit' class='dt-button btn-primary mx-3 btn btn-sm' role='button'>Hızlı Kayıt</button>";
    let place = document.getElementById("btn-add-contact");
    new_element = htmlToElement(new_element);
    place.parentNode.parentNode.insertBefore(new_element, place.parentNode);
  </script>
  <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
</body>

</html>