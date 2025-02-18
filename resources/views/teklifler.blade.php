<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <title>MYS - TEKLİFLER</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon.ico') }}" />
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <x-global-mandatory.styles />
    <link href="{{ asset('plugins/perfect-scrollbar/perfect-scrollbar.css') }}" rel="stylesheet" type="text/css" />
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

    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/table/datatable/datatables.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('plugins/table/datatable/dt-global_style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets/css/forms/theme-checkbox-radio.css') }}">
    <link href="{{ asset('assets/css/apps/invoice-list.css') }}" rel="stylesheet" type="text/css" />
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

        <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">

                <!-- CONTENT AREA -->
                <div class="page-header">
                    <nav class="breadcrumb-one" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);" style="color:whitesmoke">MYS</a>
                            </li>
                            <li class="breadcrumb-item"><a href="javascript:void(0);"
                                    style="color:whitesmoke">Teklif</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><a href="javascript:void(0);"
                                    style="color:whitesmoke">Teklifler</a></li>
                        </ol>
                    </nav>
                </div>
                @if (Session::has('success'))
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                @endif
                <div class="row layout-top-spacing">
                    <div class="col-xl-12 col-lg-12 col-sm-12 layout-spacing">
                        <div class="widget-content widget-content-area br-6">
                            <table id="invoice-list" class="table table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Teklif Numarası</th>
                                        <th>Adı</th>
                                        <th>Eposta</th>
                                        <th>Başlangıç - Bitiş Tarihi</th>
                                        <th>Miktar</th>
                                        <th>Durum</th>
                                        <th>İşlemler</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @unless (count($teklifler) == 0)
                                        @foreach ($teklifler as $teklif)
                                            <tr>
                                                <td><a href="teklif_onizle.html"><span
                                                            class="inv-number">{{ $loop->iteration }}</span></a></td>
                                                <td>
                                                    <div class="d-flex">
                                                        <div class="usr-img-frame mr-2 rounded-circle">
                                                            <img alt="avatar" class="img-fluid rounded-circle"
                                                                src="assets/img/90x90.jpg">
                                                        </div>
                                                        <p class="align-self-center mb-0 user-name">
                                                            {{ $teklif->teklif_veren_isim }} </p>
                                                    </div>
                                                </td>
                                                <td><span class="inv-email"><svg xmlns="http://www.w3.org/2000/svg"
                                                            width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round" class="feather feather-mail">
                                                            <path
                                                                d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z">
                                                            </path>
                                                            <polyline points="22,6 12,13 2,6"></polyline>
                                                        </svg> {{ $teklif->teklif_veren_email }}</span></td>
                                                <td><span class="inv-date"><svg xmlns="http://www.w3.org/2000/svg"
                                                            width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round" class="feather feather-calendar">
                                                            <rect x="3" y="4" width="18"
                                                                height="18" rx="2" ry="2"></rect>
                                                            <line x1="16" y1="2" x2="16"
                                                                y2="6"></line>
                                                            <line x1="8" y1="2" x2="8"
                                                                y2="6"></line>
                                                            <line x1="3" y1="10" x2="21"
                                                                y2="10"></line>
                                                        </svg> {{ $teklif->teklif_baslangic_tarihi }} -
                                                        {{ $teklif->teklif_bitis_tarihi }}</span></td>
                                                <td><span
                                                        class="inv-amount">{{ $teklif->istenilen_hizmet_fiyat * $teklif->istenilen_hizmet_miktar - $teklif->teklif_edilen_indirim }}</span>
                                                </td>
                                                <td><span
                                                        class="badge badge-success inv-success">{{ $teklif->teklif_durumu }}</span>
                                                </td>
                                                <td>
                                                    <div class="dropdown">
                                                        <a class="dropdown-toggle" href="#" role="button"
                                                            id="dropdownMenuLink2" data-toggle="dropdown"
                                                            aria-haspopup="true" aria-expanded="true">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                height="24" viewBox="0 0 24 24" fill="none"
                                                                stroke="currentColor" stroke-width="2"
                                                                stroke-linecap="round" stroke-linejoin="round"
                                                                class="feather feather-more-horizontal">
                                                                <circle cx="12" cy="12" r="1">
                                                                </circle>
                                                                <circle cx="19" cy="12" r="1">
                                                                </circle>
                                                                <circle cx="5" cy="12" r="1">
                                                                </circle>
                                                            </svg>
                                                        </a>
                                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink2">
                                                            <a class="dropdown-item action-edit"
                                                                href="{{ route('teklif.gozat', ['id' => $teklif->id]) }}"><svg
                                                                    xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none"
                                                                    stroke="currentColor" stroke-width="2"
                                                                    stroke-linecap="round" stroke-linejoin="round"
                                                                    class="feather feather-edit-3">
                                                                    <path d="M12 20h9"></path>
                                                                    <path
                                                                        d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z">
                                                                    </path>
                                                                </svg>Gözat</a>
                                                            <form method="post"
                                                                action="{{ route('teklif.sil', ['id' => $teklif->id]) }}">
                                                                @csrf
                                                                @method('delete')
                                                                <button class="btn btn-danger w-100 text-left pl-2"><svg
                                                                        xmlns="http://www.w3.org/2000/svg" width="24"
                                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        class="feather feather-trash">
                                                                        <polyline points="3 6 5 6 21 6"></polyline>
                                                                        <path
                                                                            d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                                        </path>
                                                                    </svg>Sil</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endunless
                                </tbody>
                            </table>
                        </div>
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
    <x-global-mandatory.scripts />
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
    <script src="{{ asset('plugins/table/datatable/button-ext/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('assets/js/apps/invoice-list.js') }}"></script>
    <!-- END PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
</body>

</html>
