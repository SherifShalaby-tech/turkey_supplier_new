<?php

namespace App\Http\Controllers;

use App\Models\AboutUs;
use App\Models\Currency;
use App\Models\Server;
use App\Models\Setting;
use App\Models\PosSetting;
use App\Models\Client;
use App\Models\Permission;
use App\Models\Warehouse;
use File;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Http\Request;
use Intervention\Image\ImageManagerStatic as Image;

class CompanySettingsController extends Controller
{


    //-------------- Update  Settings ---------------\\

    public function update(Request $request, $id)
    {

     //   $this->authorizeForUser($request->user('api'), 'update', CompanySettingPolicy::class);





        AboutUs::whereId($id)->where('user_id',NULL)->update([

            'about_us' => $request['AboutUs'],
            'services' => $request['Services'],
            'shipping_products' => $request['shipping_products'],
            'mediation' => $request['mediation'],
            'user_id' => NULL
        ]);


        return response()->json(['success' => true]);
    }





    //-------------- Get All Settings ---------------\\

    public function getSettings(Request $request)
    {

     //  $this->authorizeForUser($request->user('api'), 'view', CompanySettingPolicy::class);

        $settings = AboutUs::where('deleted_at', '=', null)->where('user_id',NULL)->first();
        if ($settings) {


            $item['id'] = $settings->id;
            $item['AboutUs'] = $settings->about_us;
            $item['Services'] = $settings->services;
            $item['shipping_products'] = $settings->shipping_products;
            $item['mediation'] = $settings->mediation;


            return response()->json([
                'settings' => $item
            ], 200);
        } else {
            return response()->json(['statut' => 'error'], 500);
        }
    }



    //-------------- Set Environment Value ---------------\\

    public function setEnvironmentValue(array $values)
    {
        $envFile = app()->environmentFilePath();
        $str = file_get_contents($envFile);
        $str .= "\r\n";
        if (count($values) > 0) {
            foreach ($values as $envKey => $envValue) {

                $keyPosition = strpos($str, "$envKey=");
                $endOfLinePosition = strpos($str, "\n", $keyPosition);
                $oldLine = substr($str, $keyPosition, $endOfLinePosition - $keyPosition);

                if (is_bool($keyPosition) && $keyPosition === false) {
                    // variable doesnot exist
                    $str .= "$envKey=$envValue";
                    $str .= "\r\n";
                } else {
                    // variable exist
                    $str = str_replace($oldLine, "$envKey=$envValue", $str);
                }
            }
        }

        $str = substr($str, 0, -1);
        if (!file_put_contents($envFile, $str)) {
            return false;
        }

        app()->loadEnvironmentFrom($envFile);

        return true;
    }

}
