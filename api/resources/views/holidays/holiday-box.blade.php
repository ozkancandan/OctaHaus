@if(is_array($data) && count($data)>0)
    @foreach($data as $k=>$h)
        @if(is_array($h))
            <div class="search-box">
                <ul class="holiday-detail">
                    <li>
                        <p>{{dateFormat($h["date"]??"")}}</p>
                        <b>{{$h["localName"]??""}}</b>
                    </li>
                    <li>
                        <div class="form-group">
                            <input type="checkbox" name="holidays[]" value="{{base64_encode(json_encode($h))}}" id="holiday_{{$k}}">
                            <label for="holiday_{{$k}}"></label>
                        </div>
                    </li>
                </ul>
            </div>
        @endif
    @endforeach
@else
    <div class="search-box">Bu yıl için belirtmiş olduğunuz ülke için tatil kaydı bulunamadı!</div>
@endif
