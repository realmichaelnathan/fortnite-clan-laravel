<?php

namespace App;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;

use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    //

    public function twitter_followers() {
        $client = new Client();
        $response = $client->get("https://cdn.syndication.twimg.com/widgets/followbutton/info.json?screen_names=$this->twitter");
        return json_decode($response->getBody()->getContents())[0]->followers_count;
    }


    public function instagram_followers() {
        $client = new Client();
        $response = $client->get("https://instagram.com/$this->instagram/?__a=1");
        return json_decode($response->getBody()->getContents())->graphql->user->edge_followed_by->count;
    }

    public function discord_members() {
        $auth_token = env('DISCORD_AUTH_TOKEN');

        $client = new Client();
        $response = $client->get("https://discordapp.com/api/guilds/$this->discord/members?limit=1000", ["headers" => ["Authorization" => $auth_token]]);
        return count(json_decode($response->getBody()->getContents()));

        // $json_options = [ "http" => [ "method" => "GET", "header" => "Authorization: $auth_token" ] ]; 
        // $json_context = stream_context_create($json_options); 
        // $json_get = file_get_contents("https://discordapp.com/api/guilds/$this->discord/members?limit=1000", false, $json_context); 
        // $json_decode = json_decode($json_get, true);
        // return count($json_decode); 

    }


}
