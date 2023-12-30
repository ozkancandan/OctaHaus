@include("include/header")

    <div class="container">
        <div class="header">
            <ul class="centered-menu">
                <li >
                    <a class="active" href="/">Aktarım</a>
                </li>
                <li>
                    <a href="/calendar">Takvim</a>
                </li>
            </ul>
        </div>
        <form id="seachForm" method="post">
            @csrf
            <div class="search-box">
                <ul class="search-inputs">
                    <li>
                        <select class="form-control" name="countryCode">
                            @foreach($countryList as $country)
                                <option value="{{$country["cca2"]}}">{{$country["name"]["common"]}}</option>
                            @endforeach
                        </select>
                    </li>
                    <li>
                        <input type="number" name="year" class="form-control" value="{{date("Y")}}">
                    </li>
                    <li>
                        <button type="button" class="btn btn-black get-holidays">Getir</button>
                    </li>
                </ul>
            </div>
        </form>
        <form method="post" id="holidayListForm">
            @csrf
            <div class="holiday-list">

            </div>
        </form>
        <div class="text-center">
            <button type="button" class="btn btn-black import-btn" style="display: none">İçeri Aktar</button>
        </div>
    </div>




@section("scripts")
    <script>
        $(document).on("click",".get-holidays",function () {

            $.ajax({
                type: "POST",
                url: "{{route("get-holidays")}}",
                data:$("#seachForm").serializeArray(),
                success: function(data) {
                    $(".holiday-list").html("")
                    $(".import-btn").hide()
                    if(data!=null){
                        $(".holiday-list").append(data.boxes);
                        if(data.count>0){
                            $(".import-btn").show()
                        }
                    }

                },error: function (xhr, status, error) {
                    // Handle the error here
                    let result = $.parseJSON(xhr.responseText);
                    alert(result.message);
                }
            });
        })

        $(document).on("click",".import-btn",function () {
            $.ajax({
                type: "POST",
                url: "{{route("import-holidays")}}",
                data:$("#holidayListForm").serializeArray(),
                success: function(data) {
                    alert("Kaydınız Başarıyla Alınmıştır!")
                    window.location.href="{{route("calendar")}}";

                },error: function (xhr, status, error) {
                    // Handle the error here
                    let result = $.parseJSON(xhr.responseText);
                    alert(result.message);
                }
            });
        })
    </script>

@endsection
@include("include/footer")
