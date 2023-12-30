@include("include/header")

<div class="container">
    <div class="header">
        <ul class="centered-menu">
            <li >
                <a href="/">Aktarım</a>
            </li>
            <li>
                <a class="active" href="/calendar">Takvim</a>
            </li>
        </ul>
    </div>
    @if(\Session::get('status') == "500")
        <div class="row mb-2">
            <div class="col-md-12">
                <div class="alert alert-danger alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h5><i class="icon fas fa-ban"></i> Hata!</h5>
                    {!! \Session::get('error') !!}
                </div>
            </div>
        </div>
    @endif
    <form method="post" id="holidayListForm">
        @csrf
        <div class="holiday-list">
            @if(is_array($data) && count($data)==0)
                <div class="search-box">Kayıt bulunamadı!</div>
            @endif
            @foreach($data as $k=>$h)
                <div class="search-box">
                    <ul class="holiday-detail">
                        <li>
                            <p>{{dateFormat(date("Y-m-d",strtotime($h["holiday_date"])))}}</p>
                            <b>{{$h["holiday_name"]??""}}</b>
                        </li>
                        <li>
                            <button type="button" class="btn btn-outline-black edit-btn" data-code="{{$h["code"]}}" data-detail="{{$h["detail"]}}" data-name="{{$h["holiday_name"]}}" data-date="{{date("Y-m-d",strtotime($h["holiday_date"]))}}">Düzenle</button>
                        </li>
                    </ul>
                </div>
            @endforeach
        </div>
    </form>
</div>
<style>
    .popup-bg {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100vh;
        background: #383838;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }
    .popup {
        position: relative;
        width: 450px;
        margin: auto;
        background: white;
        padding: 15px;
        box-shadow: 5px 5px 0px #4b4b4b;
    }
    .popup .container {
        position: relative;
        display: flex;
        flex-direction: column;
        gap: 25px;
    }
    .popup-body .flex-column {
        position: relative;
        display: grid;
        grid-template-columns: 2fr 3fr;
        gap: 10px;
        margin-bottom: 10px;
    }
    a.cancel{
        font-size: 10px;
    }
    #date {
        padding-right: 30px; /* Input sağ tarafında 30px boşluk bırak */
    }

    .takvim-icon {
        position: absolute;
        top: 12px;
        right: 10px; /* Sağ tarafta 10px boşluk */
        transform: translateY(-50%);
        cursor: pointer;
    }
    span.takvim-icon img {
        width: 14px;
    }
    input#date {
        font-size: 10px;
        padding: 6px;
        width: 100%;
        border: 1px solid;
    }
    .x-icon {
        display: inline-block;
        width: 24px;
        height: 24px;
        cursor: pointer;
    }
    .popup-bg{
        display: none;
    }
    input{
        color: black!important;
    }
</style>
<div class="popup-bg">
    <form method="post" action="{{route("calendar-update")}}">
        <div class="popup">
            <div class="container">
                    @csrf
                    <div class="popup-header">
                        <span>Düzenle</span>
                        <div class="x-icon float-right cancel-btn">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                <line x1="6" y1="6" x2="18" y2="18"></line>
                            </svg>
                        </div>
                    </div>
                    <div class="popup-body">
                        <input type="hidden" name="code" value="">
                        <div class="flex-column">
                            <div style="position: relative;">
                                <input type="text" id="date" name="date" placeholder="01 Ocak 2024">
                                <span class="takvim-icon">
                                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/c/ca/Calendar_icon_2.svg/989px-Calendar_icon_2.svg.png">
                                </span>
                            </div>
                            <input type="text" class="form-control" name="name" value="">
                        </div>
                        <div class="">
                            <textarea rows="4" class="form-control" name="detail" placeholder="Not Ekle"></textarea>
                        </div>
                    </div>
                    <div class="popup-footer">
                        <a href="#" class="cancel-btn">İptal</a>
                        <button type="submit" class="btn btn-black float-right">Kaydet</button>
                    </div>
            </div>
        </div>
    </form>
</div>
@section("scripts")
    <!-- Pikaday kütüphanesini eklemek için CDN -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment-with-locales.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pikaday/1.8.0/pikaday.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/pikaday/1.8.0/css/pikaday.min.css">


    <script>
        moment.locale('tr');
        // Sayfa yüklendiğinde çalışacak JavaScript kodu
        document.addEventListener("DOMContentLoaded", function () {
            // date seçiciyi etkinleştir
            var datePicker = new Pikaday({
                field: document.getElementById('date'),
                format: 'DD MMMM YYYY', // Gün Ay Yıl
                yearRange: [1900, moment().year() + 10], // Opsiyonel: Yıl aralığı
                showYearDropdown: true, // Yıl seçiciyi göster
                yearSuffix: '', // Yıl seçicinin sonuna ek bir metin ekle
                i18n: {
                    previousMonth: 'Önceki Ay',
                    nextMonth: 'Sonraki Ay',
                    months: ['Ocak', 'Şubat', 'Mart', 'Nisan', 'Mayıs', 'Haziran', 'Temmuz', 'Ağustos', 'Eylül', 'Ekim', 'Kasım', 'Aralık'],
                    weekdays: ['Pazar', 'Pazartesi', 'Salı', 'Çarşamba', 'Perşembe', 'Cuma', 'Cumartesi'],
                    weekdaysShort: ['Paz', 'Pzt', 'Sal', 'Çar', 'Per', 'Cum', 'Cmt']
                }
            });

            // Input elemanına tıklandığında datepicker'ı aç
            document.getElementById('date').addEventListener('click', function () {
                datePicker.show();
            });

            // Takvim ikonuna tıklandığında datepicker'ı aç
            document.querySelector('.takvim-icon').addEventListener('click', function () {
                datePicker.show();
            });
        });

        $(document).on("click",".cancel-btn",function () {
            $(".popup-bg").hide();
        })

        $(document).on("click",".edit-btn",function () {
            let name = $(this).data("name");
            let detail = $(this).data("detail");
            let code = $(this).data("code");

            var date = moment($(this).data("date"), "Y-M-D").format("DD MMMM YYYY");

            $("#date").val(date);
            $('input[name="name"]').val(name)
            $('textarea[name="detail"]').val(detail)
            $('input[name="code"]').val(code)

            $(".popup-bg").css("display","flex");
        })
    </script>
@endsection
@include("include/footer")
