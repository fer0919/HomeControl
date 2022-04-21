<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use App\Models\GroupFeed;
use Log;
class GroupsController extends Controller
{
    public function GetGroups(){ 
        
        $response = Http::withHeaders(['X-AIO-Key' => 'aio_dzEK81T5ABSEjrKOv8LHuB4ilCBn'])
        ->get('https://io.adafruit.com/api/v2/Myrka_53/groups');
        $group_key = $response['group_key'];
        $created_at = $response['created_at'];
        $updated_at = $response['updated_at'];
        $group_id = $response['group_id'];

        $registro = GroupFeed::create([     
             'created_at' =>$created_at,
             'updated_at'=>$updated_at,
             'value' =>$value,
             'feed_id' =>$feed_id,
         ]);{
         }
         return $registro;

    } 
    
    public function PostGrupo(Request $request){
        $response = Http::withHeaders([
            'X-AIO-Key' => 'aio_dzEK81T5ABSEjrKOv8LHuB4ilCBn',
        ])->post('https://io.adafruit.com/api/v2/Myrka_53/groups', [
            'value' => $request->get('value'),
            'updated_at' => $request->get('updated_at'),
            'feed_id' => $request->get('feed_id')
        ]);  
        
        return $response;
        
    }
    
}
