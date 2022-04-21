<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;
use App\Models\Casa;
use App\Models\ServoCochera;
use App\Models\Humedad;
use App\Models\Humo;
use App\Models\Luminosidad;
use App\Models\Temperatura;
use App\Models\Ultrasonico;
use App\Models\Grupo;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class AdafruitController extends Controller
{
    public function createGrupo(Request $request){
        $url = 'https://io.adafruit.com/api/v2/Myrka_53/groups';
        $header = [ 'headers' => ['X-AIO-Key' => 'aio_dzEK81T5ABSEjrKOv8LHuB4ilCBn',]];
        $client = new Client($header);
        $response = $client->post($url, ['form_params' => ['name' => $request->get('name')]]);
        
        //Guardar los datos en la base de datos
        $registro = Grupo::create([  
             'group_key' => $request->get('name'),
         ]);

        return $registro;   //Returna datos insertados
    }

    public function createFeed(Request $request){
        $group = $request->group;
        $name = $request->name;

        $url = 'https://io.adafruit.com/api/v2/Myrka_53/groups/'.$group.'/feeds';
        $header = [ 'headers' => ['X-AIO-Key' => 'aio_dzEK81T5ABSEjrKOv8LHuB4ilCBn',]];
        $client = new Client($header);
        $response = $client->post($url, ['form_params' => ['name' => $request->get('name')]]);
        
        $resp = json_decode($response->getbody());

        return $resp;   //Returna datos insertados
    }

    //Mandar datos al sensor 'ServoCochera' para abir o cerrar (1, 0)
    public function PostServo(Request $request){
        $response = Http::withHeaders([
            'X-AIO-Key' => 'aio_dzEK81T5ABSEjrKOv8LHuB4ilCBn',
        ])->post('https://io.adafruit.com/api/v2/Myrka_53/feeds/abrircochera/data', [
            'value' => $request->get('value'),
        ]);  
        //Obtener ultimos dato registrado en adafruit (solo nos traera eñ value, id, fecha modificacion)
        $response = Http::withHeaders(['X-AIO-Key' => 'aio_dzEK81T5ABSEjrKOv8LHuB4ilCBn'])
        ->get('https://io.adafruit.com/api/v2/Myrka_53/feeds/abrircochera/data/last');
        $value = $response['value'];
        $updated_at = $response['updated_at'];
        $feed_id = $response['feed_id'];
        //Guardar los datos en la base de datos
        $registro = ServoCochera::create([     
             'updated_at'=>$updated_at,
             'value' =>$value,
             'feed_id' =>$feed_id,
         ]);{
        }   
         return $registro;   //Returna datos insertados
    }
    //mostrar todos los datos registrados en la tabla 'feed_servomotor'
    public function GetServomotor(){
        $_servomotor_cochera = ServoCochera::all();
        return $_servomotor_cochera;
    }

    public function InsertarHumedad(){ 
        //obtener ultimo dato registrado
        $response = Http::withHeaders(['X-AIO-Key' => 'aio_dzEK81T5ABSEjrKOv8LHuB4ilCBn'])
        ->get('https://io.adafruit.com/api/v2/Myrka_53/feeds/humedad/data/last');
        $value = $response['value'];
        $created_at = $response['created_at'];
        $updated_at = $response['updated_at'];
        $feed_id = $response['feed_id'];
        $registro = Humedad::create([      //Guardar registro en la base de datos
             'created_at' =>$created_at,
             'updated_at'=>$updated_at,
             'value' =>$value,
             'feed_id' =>$feed_id,
         ]);{
         }
         return $registro; //returnar registro
    } 

    public function GetHumedad(){//
        $feed_humedad = Humedad::all();
        return $feed_humedad;
    }
    public function InsertarHumo(){ 
        $response = Http::withHeaders(['X-AIO-Key' => 'aio_dzEK81T5ABSEjrKOv8LHuB4ilCBn'])
        ->get('https://io.adafruit.com/api/v2/Myrka_53/feeds/humo/data/last');
        $value = $response['value'];
        $created_at = $response['created_at'];
        $updated_at = $response['updated_at'];
        $feed_id = $response['feed_id'];
        $registro = Humo::create([     
             'created_at' =>$created_at,
             'updated_at'=>$updated_at,
             'value' =>$value,
             'feed_id' =>$feed_id,
         ]);{
         }
         return $registro;
    } 
    public function GetHumo(){
        $feed_humo = Humo::all();
        return $feed_humo;
    }
    public function InsertarMovimiento(){ 
        $response = Http::withHeaders(['X-AIO-Key' => 'aio_dzEK81T5ABSEjrKOv8LHuB4ilCBn'])
        ->get('https://io.adafruit.com/api/v2/Myrka_53/feeds/ultrasonico/data/last');
        $value = $response['value'];
        $created_at = $response['created_at'];
        $updated_at = $response['updated_at'];
        $feed_id = $response['feed_id'];
        $registro = Ultrasonico::create([     
             'created_at' =>$created_at,
             'updated_at'=>$updated_at,
             'value' =>$value,
             'feed_id' =>$feed_id,
         ]);{
         }
         return $registro;
    } 

    public function GetMovimiento(){
        $feed_ultrasonido = Ultrasonico::all();
        return $feed_ultrasonido;
    }

    public function InsertarTemperatura(){   
        $response = Http::withHeaders(['X-AIO-Key' => 'aio_dzEK81T5ABSEjrKOv8LHuB4ilCBn'])
        ->get('https://io.adafruit.com/api/v2/Myrka_53/feeds/temperatura/data/last');
        $value = $response['value'];
        $created_at = $response['created_at'];
        $updated_at = $response['updated_at'];
        $feed_id = $response['feed_id'];
        $registro = Temperatura::create([     
             'created_at' =>$created_at,
             'updated_at'=>$updated_at,
             'value' =>$value,
             'feed_id' =>$feed_id,
         ]);{
         }
         return $registro;
    } 

    public function Get_AllTemperatura(){
        $feed_temperatura = Temperatura::all();
        return $feed_temperatura;
    }
    public function InsertarLuminosidad(){   
        $response = Http::withHeaders(['X-AIO-Key' => 'aio_dzEK81T5ABSEjrKOv8LHuB4ilCBn'])
        ->get('https://io.adafruit.com/api/v2/Myrka_53/feeds/luz/data/last');
        $value = $response['value'];
        $created_at = $response['created_at'];
        $updated_at = $response['updated_at'];
        $feed_id = $response['feed_id'];
        $registro = Luminosidad::create([     
             'created_at' =>$created_at,
             'updated_at'=>$updated_at,
             'value' =>$value,
             'feed_id' =>$feed_id,
         ]);{
         }
         return $registro;
    } 

    public function GetLuminosidad(){
        $feed_temperatura = Luminosidad::all();
        return $feed_temperatura;
    }
//Añadir Nueva Casa
    public function añadirHab($nombre){
        $nomFeed=self::feedId($nombre);
        $url="https://io.adafruit.com/api/v2/Myrka_53/groups";
        $response=Http::post($url,[
            'X-AIO-Key'=>env('aio_dzEK81T5ABSEjrKOv8LHuB4ilCBn'),
            'name'=>$nomFeed
        ]);
        return $response->object();
    }
    public function feedId($nombre){
        $feed = strtolower($nombre);
        $searchString = " ";
        $replaceString = "";
        $originalString = $feed; 
 
        $feedKey = str_replace($searchString, $replaceString, $originalString);
        return $feedKey;
    }

    
    
}
