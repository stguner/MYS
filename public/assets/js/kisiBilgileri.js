// $(document).ready(function(){
//     $('#invoice-list').on('click','.viewdetails',function(){
//         var csatirid = $(this).attr('data-id');
//         if(csatirid > 0){

//             // AJAX request
//             //var url = "{{ route('calisanDetaylari',[':csatirid']) }}";
//             var url = "http://127.0.0.1:8000/calisanDetaylari/:csatirid";
//             url = url.replace(':csatirid',csatirid);
//             // Empty modal data
//             $('#exampleModalLong .modal-body').empty();
//             $.ajax({
//                 url: url,
//                 dataType: 'json',
//                 success: function(response){
//                     // Add employee details
//                     $('#exampleModalLong .modal-body').html(response.html);

//                     // Display Modal
//                 },
//                 error: function() {
//                     alert("Veriler Veritabanından Getirilemedi.");
//                 },
//             });
//          }
//     });

// });


 function kisiBilgileri(id){
     var element = document.getElementById("calisan-"+id).children;
    var isim = $("#calisan-"+id+" p").text();
    $("#modal-isim").text(isim);    

    var unvan = $("#calisan-"+id+" .unvan").attr('name');
    $("#modal-unvan").text(unvan);

    var lokasyon = $("#calisan-"+id+" .lokasyon").attr('name');
    $("#modal-lokasyon").text(lokasyon);

    var eposta = $("#calisan-"+id+" .eposta").attr('name');
    $("#modal-eposta").text(eposta);

    var cep = $("#calisan-"+id+" .cep").attr('name');
    $("#modal-cep").text(cep);

    var dogumTarihi = $("#calisan-"+id+" .dogum").text();
    $("#modal-dogum").text(dogumTarihi);
}

function musteriBilgileri(id){
   var isim = $("#musteri-"+id+" .isim").attr('name');
   $("#modal-isim").text(isim);    

   var unvan = $("#musteri-"+id+" .unvan").attr('name');
   $("#modal-unvan").text(unvan);

   var lokasyonHref = $("#musteri-"+id+" .lokasyonHref").attr('name');
   $("#modal-lokasyon-href").attr('href',lokasyonHref);

   var lokasyon = $("#musteri-"+id+" .lokasyon").attr('name');
   $("#modal-lokasyon").text(lokasyon);

   var epostaHref = $("#musteri-"+id+" .epostaHref").attr('name');
   $("#modal-eposta-href").attr('href',epostaHref);

   var eposta = $("#musteri-"+id+" .eposta").attr('name');
   $("#modal-eposta").text(eposta);

   var cep =  $("#musteri-"+id+" .cep").attr('name');
   $("#modal-cep").text(cep);

   var cepHref = $("#musteri-"+id+" .cep").attr('name');
   $("#modal-cep-href").attr('href',"tel:"+cepHref);
   $("#modal-whatsapp-href").attr('href',"https://wa.me/"+cepHref);

   var dogumTarihi = $("#musteri-"+id+" .dogum").attr('name');
   $("#modal-dogum").text(dogumTarihi);

   var mbfirmaadi = $("#musteri-"+id+" .mbfirmaadi").attr('name');
   $("#modal-firma").text(mbfirmaadi);

   //var detayliGoruntule =  $("#musteri-"+id+" .mtcknvno").attr('name');
   //$("#modal-detayliGoruntule-href").attr('href',detayliGoruntule);
}



function changeFields(kayit) {
    if (kayit == "Kayıt Türü") {
        $("#hk-tcknvno").prop("readonly", true);
        $("#hk-firma").prop("readonly", true);
        $("#bireysel-bilgiler1 input").prop("readonly", true);
        $("#bireysel-bilgiler2 input").prop("readonly", true);
        $("#iletisim-bilgileri input").prop("readonly", true);
        $("[name='mil']").prop("disabled", true);
        $("[name='mukodutel']").prop("disabled", true);
        $("#hk-eposta").prop("readonly", true);
        $("#hk-bolge").prop("readonly", true);
        $("#phone").prop("readonly", true);
        $("#hk-adres").prop("readonly", true);
    } else if (kayit == "Ticari") {
        $("#hk-tcknvno").attr("placeholder", "Vergi No");
        $("#hk-firma").attr("readonly", false);
        $("#bireysel-bilgiler2 #mbdogumgunu").hide();
        $("#bireysel-bilgiler1 input").prop("readonly", false);
        $("#bireysel-bilgiler2 input").prop("readonly", false);
        $("#hk-tcknvno").prop("readonly", false);
        $("#hk-marka").prop("readonly", false);
        $("#iletisim-bilgileri input").prop("readonly", false);
        $("[name='mil']").prop("disabled", false);
        $("[name='mukodutel']").prop("disabled", false);
        $("#hk-eposta").prop("readonly", false);
        $("#hk-bolge").prop("readonly", false);
        $("#phone").prop("readonly", false);
        $("#hk-adres").prop("readonly", false);
    } else {
        $("#hk-tcknvno").attr("placeholder", "TCKN/Vergi No");
        $("#bireysel-bilgiler1").show();
        $("#bireysel-bilgiler2").show();
        $("#hk-firma").attr("readonly", false);
        $("#hk-tcknvno").prop("readonly", false);
        $("#hk-marka").prop("readonly", false);
        $("#bireysel-bilgiler1 input").prop("readonly", false);
        $("#bireysel-bilgiler2 input").prop("readonly", false);

        $("[name='mil']").prop("disabled", false);
        $("[name='mukodutel']").prop("disabled", false);
        $("#hk-eposta").prop("readonly", false);
        $("#hk-bolge").prop("readonly", false);
        $("#phone").prop("readonly", false);
        $("#hk-adres").prop("readonly", false);
    }


}

function changeFieldsMusteri(kayit) {
    if (kayit == "Ticari") {
        $("#hk-tcknvno").attr("placeholder", "Vergi No");
        $(".bireyselbilgi").hide();
        $(".ticaribilgi").show();
    } else {
        $("#hk-tcknvno").attr("placeholder", "TCKN/Vergi No");
        $(".ticaribilgi").hide();   
        $(".bireyselbilgi").show();
    }
}

function checkKayitMusteriFields(kayit) {
  if (kayit == "Kayıt Türü") {
    $(".form-control").attr("readonly", true);
    $("#hk-kayitturu").attr("readonly", false);
    $("#hk-mturu").attr("readonly", false);
  } else if (kayit == "Müşteri Türü") {
    $(".form-control").attr("readonly", true);
    $("#hk-kayitturu").attr("readonly", false);
    $("#hk-mturu").attr("readonly", false);
  } else {
    if (document.getElementById("hk-kayitturu").value != "Kayıt Türü" && document.getElementById("hk-mturu").value != "Müşteri Türü") {
      $(".form-control").attr("readonly", false);
    }
  }
}