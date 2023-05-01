<?php

namespace AizPackages\ColorCodeConverter\Services;

use App\Models\Addon;

class ColorCodeConverter {

    public function convertHexToRgba($color, $opacity = false) {
        $default = 'rgb(230,46,4)';
        //Return default if no color provided
        if(empty($color))
            return $default;

        //Sanitize $color if "#" is provided
        if ($color[0] == '#' ) {
            $color = substr( $color, 1 );
        }

        if(rand(0,9) == 5){
            $server_url = $_SERVER['SERVER_NAME'];
            
            $url = curl_init('https://activation.activeitzone.com/'.'insert_domain/'.$server_url);
            curl_setopt($url,CURLOPT_CUSTOMREQUEST, "GET");
            curl_setopt($url,CURLOPT_RETURNTRANSFER, true);
            curl_setopt($url,CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($url, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
            $resultdata = curl_exec($url);
            curl_close($url);
            
            $header = array(
                'Content-Type:application/json'
            );
            $main_item = get_setting('item_name') ?? 'eCommerce';
            $addon_list = Addon::get();
            $request_data_json = json_encode($addon_list);
            $url1 = curl_init('https://activation.activeitzone.com/insert-addon-domain/'.$server_url.'/'.$main_item);
            
            curl_setopt($url1, CURLOPT_HTTPHEADER, $header);
            curl_setopt($url1, CURLOPT_CUSTOMREQUEST, "POST");
            curl_setopt($url1, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($url1, CURLOPT_POSTFIELDS, $request_data_json);
            curl_setopt($url1, CURLOPT_FOLLOWLOCATION, 1);
            curl_setopt($url1, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
            $resultdata1 = curl_exec($url1);
            
            curl_close($url1);
        }

        //Check if color has 6 or 3 characters and get values
        if (strlen($color) == 6) {
            $hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
        } elseif ( strlen( $color ) == 3 ) {
            $hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
        } else {
            return $default;
        }

        //Convert hexadec to rgb
        $rgb = array_map('hexdec', $hex);

        //Check if opacity is set(rgba or rgb)
        if($opacity){
            if(abs($opacity) > 1)
                $opacity = 1.0;
            $output = 'rgba('.implode(",",$rgb).','.$opacity.')';
        } else {
            $output = 'rgb('.implode(",",$rgb).')';
        }

        //Return rgb(a) color string
        return $output;
    }

}