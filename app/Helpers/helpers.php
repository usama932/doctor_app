<?php

if (! function_exists('asset_img')) {
    function asset_img($path = null, $filename = null) {
        if($path && $filename && file_exists(public_path("/storage/images/".$path."/".$filename))){
            return asset("/storage/images/".$path."/".$filename);
        }
        return asset("/storage/images/placeholder.png");
    }
}
