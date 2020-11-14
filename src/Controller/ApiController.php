<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpClient\CachingHttpClient;
use Symfony\Component\HttpClient\HttpClient;
use Symfony\Component\HttpKernel\HttpCache\Store;

class ApiController extends AbstractController
{
    static function call_api(string $api_name="snapshot",string $requested_value='')
    {
        if($api_name === "snapshot") { 
        $store = new Store('/var/cache/');
        $client = HttpClient::create();
        $client = new CachingHttpClient($client, $store);

        $snapshot = $client->request(
            'GET',
            'https://bitnodes.io/api/v1/snapshots/latest'
        );
        if (200 !== $snapshot->getStatusCode()) {
            throw new \Exception('Error: unable to load the node total.');
        }
        $content = $snapshot->toArray();

        return $content; //array
    }

    elseif($api_name === "price") {

        $store = new Store('/var/cache/');
        $client = HttpClient::create();
        $client = new CachingHttpClient($client, $store);

        
        // this won't hit the network if the resource is already in the cache
        $price = $client->request('GET', 'https://blockchain.info/q/24hrprice');

        if ( 200 !== $price->getStatusCode() ) {
            throw new \Exception('Error: unable to load the price.');
        }

        $content = $price->getContent();

        return $content; //float

    }
    elseif($api_name === 'blockheight') {
        $store = new Store('/var/cache/');
        $client = HttpClient::create();
        $client = new CachingHttpClient($client, $store);

        // this won't hit the network if the resource is already in the cache
        $call = $client->request('GET', 'https://blockchain.info/q/getblockcount');

        if ( 200 !== $call->getStatusCode() ) {
            throw new \Exception('Error: unable to load the block height.');
        }
        $response = $call->getContent();

        return $response;
    }
    
    else {
        throw new \Exception('Error: cannot determine the API name requested.');

    }
    }
}
