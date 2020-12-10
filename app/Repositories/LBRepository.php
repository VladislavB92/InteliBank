<?php

namespace App\Repositories;

use App\Models\Currency;

class LBRepository implements CurrenciesRepository
{

    function getBySymbol(string $symbol): float
    {
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL            => 'https://www.bank.lv/vk/ecb.xml',
            CURLOPT_RETURNTRANSFER => TRUE,
            CURLOPT_ENCODING       => 'UTF-8'
        ));

        $data = curl_exec($curl);
        curl_close($curl);


        $xml = simplexml_load_string($data);

        $json = json_encode($xml);

        $data = json_decode($json, TRUE);
        $currencyData = $data['Currencies']['Currency'];

        foreach($currencyData as $currencyData)
        {
            if ($currencyData['ID'] == $symbol){
                return((float)$currencyData['Rate']);
            }
        }
        
    }
}
