<?php
/**
 * Created by PhpStorm.
 * User: Alan Hurtarte
 * Date: 2019-04-19
 * Time: 10:45
 */

namespace App\Objects;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class DesignsApiGetter
{

    const API_URL = 'https://appdsapi-6aa0.kxcdn.com/content.php?lang=de&json=1&search_text=berlin&currencyiso=EUR';

    /**
     * @return array
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function getDesigns()
    {
        $client = new Client();
        $response = $client->get(self::API_URL);
//        dd($response);

        if($response->getStatusCode() != 200) {
            Log::error('Api status code not success');
            return [];
        }

        $api_results = json_decode($response->getBody()->getContents(), true);

        $designs = [];

        if(!$api_results['content'])
            return [];

        foreach ($api_results['content'] as $design_raw) {
            $designs[] = new Design($design_raw);
        }

        return $designs;
    }
}
