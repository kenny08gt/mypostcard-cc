<?php
/**
 * Created by PhpStorm.
 * User: Alan Hurtarte
 * Date: 2019-04-19
 * Time: 10:45
 */

namespace App\Objects;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class ApiHandler
{

    const CONTENT_API_URL = 'https://appdsapi-6aa0.kxcdn.com/content.php?lang=de&json=1&search_text=berlin&currencyiso=EUR';
    const PRODUCT_PRICE_API_URL = 'https://www.mypostcard.com/mobile/product_prices.php?json=1&type=get_postcard_products&currencyiso=EUR&store_id=';

    /**
     * @return array
     */
    public function fetchDesigns()
    {
        try {
            if(Cache::has('designs'))
                return Cache::get('designs');


            $client = new Client();
            $response = $client->get(self::CONTENT_API_URL);

            if ($response->getStatusCode() != 200) {
                Log::error('Api status code not success');
                return [];
            }

            $api_results = json_decode($response->getBody()->getContents(), true);

            $designs = [];

            if (!$api_results['content'])
                return [];

            foreach ($api_results['content'] as $design_raw) {
                $design = new Design($design_raw);
                $design->setProducts($this->fetchProductPrices($design->getId()));
                $designs[] = $design;
            }

            Cache::put('designs', $designs,60*24*7);

            return $designs;
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return [];
        }
    }

    public function fetchProductPrices($design_id)
    {
        try {
            $client = new Client();
            $response = $client->get(self::PRODUCT_PRICE_API_URL.$design_id);

            if ($response->getStatusCode() != 200) {
                Log::error('Api status code not success');
                return [];
            }

            $api_results = json_decode($response->getBody()->getContents(), true);
            $products = [];

            foreach ($api_results['products'] as $product_raw) {
                $product = new Product($product_raw);
                $products[strtolower($product->getAssignedtype())] = $product;
            }

            return $products;

        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            return [];
        }
    }
}
