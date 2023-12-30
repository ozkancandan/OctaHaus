<?php
namespace App\Http\Controllers\Calendar;
use App\Library\External\Countries\Countries;
use App\Library\Http\HttpManager;
use App\Models\Calendar;
use Carbon\Carbon;


class HolidaysController
{

    public function index()
    {
        $countries = new Countries();
        $countryList = $countries->countryList();

        if(!is_array($countryList)){
            throw new LogicException("Ülke Listesi Alınamadı!");
        }

        $data =[
            "countryList"=>$countryList
        ];

        return view("transfer",$data);
    }

    public function getHolidays()
    {

        //return dateFormat("2024-01-01");
        request()->validate([
            'year' => 'required|date_format:Y',
            'countryCode' => 'required|alpha|size:2', // Assuming countryCode should be a two-letter code
        ]);

        $http = new HttpManager();
        $http->setBaseUrl("https://date.nager.at/");
        $data = [
            request()->get("year"),
            request()->get("countryCode")
        ];
        $result =$http->get("api/v3/publicholidays/".implode("/",$data));


        return response()->json([
            "boxes"=>view("holidays.holiday-box",["data"=>$result->result??[]])->render(),
            "count"=>count($result->result??[])
        ]);

    }

    public function import()
    {
        request()->validate([
            'holidays' => 'required|array',
        ]);

        $data = [];

        foreach (request()->get("holidays") as $holiday){
            $decodedData = json_decode(base64_decode($holiday),1);
            $data[] = [
                "code"=>crc32(uuid()),
                "holiday_date"=>$decodedData["date"],
                "holiday_name"=>$decodedData["localName"]
            ];
        }

        $result = new Calendar();
        return $result->add($data);
    }

    public function update()
    {
        try {

            request()->validate([
                'code' => 'required|integer',
            ]);

            $calendar = new Calendar();
            $existingHoliday = $calendar->where("code",request()->get("code"))->first();

            if ($existingHoliday) {
                $existingHoliday->update([
                    "holiday_date"=>Carbon::createFromFormat('d F Y', monthTr2En(request()->get("date")))->format('Y-m-d'),
                    "holiday_name"=>request()->get("name"),
                    "detail"=>request()->get("detail"),
                ]);
            }
        }catch (Exeption $e){
            return redirect()->back()->with('error', 'Hata! '.$e->getMessage())->with("status",500);
        }

        return redirect()->back()->with('success', 'Güncelleme Başarılı!')->with("status",200);
    }

    public function stored()
    {
        $calendar = new Calendar();
        return view("calendar",["data"=>$calendar->all()->toArray()]);
    }
}
