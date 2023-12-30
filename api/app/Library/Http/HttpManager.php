<?php
namespace App\Library\Http;

class HttpManager
{
    private $baseURl;
    public $result;

    public function setBaseUrl($url)
    {
        $this->baseURl=$url;
    }

    public function get($path, $data = array(), $header=array())
    {
        try {
            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => $this->baseURl.$path,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_POSTFIELDS =>$data,
                CURLOPT_HTTPHEADER => $header
            ));

            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);

            if ($err) {
                $this->result = $err;
            } else {
                $this->result = json_decode($response, 1);
            }

        }catch (Exception $e){
            return $e->getMessage();
        }

        return $this;
    }
}
