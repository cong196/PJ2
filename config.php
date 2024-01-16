<?php

$url = '';
$ck = '';
$cs = '';
function getChatGPTKey(){
    //return "";
    return "";
}
function getGoogleGeminiAPI(){
    return "";
}
function getKey($site){
    if($site == 'themegatee-editproduct.php' || $site == 'themega-editdraftproduct.php' || $site == 'themega_editdraftproduct.php' || $site == 'themegatee-setting.php' || $site == 'themegatee' || $site == 'themegatee-schedule-product.php') {
        $data = '{
            "url": "https://themegatee.com",
            "ck" : "ck_87beed3473355a6ace23dcbb2ae8a5493baef275",
            "cs" : "cs_c79fa1db19ed6b4940a5109d247c486bed4585cb"

        }';

        return $data;
    } else {
        if($site == 'kacogifts-editproduct.php' || $site == 'kacogifts-editdraftproduct.php' || $site == 'kacogifts_editdraftproduct.php' || $site == 'kacogifts-setting.php' || $site == 'kacogifts' || $site == 'kacogifts-createpost.php') {
             $data = '{
                "url": "https://kacogifts.com",
                "ck" : "ck_26e2b0b45e5b19190e5dc0504002cca4cd7702a8",
                "cs" : "cs_0eddf1d7b6b651f47bce09f09aad3262e3294e3f"
            }';

            return $data;
        } else {
            if($site == 'customjoygifts-editproduct.php' || $site == 'customjoygifts-editdraftproduct.php' || $site == 'customjoygifts_editdraftproduct.php' || $site == 'customjoygifts-setting.php' || $site == 'customjoygifts' || $site == 'customjoygifts-schedule-product.php') {
                $data = '{
                    "url": "https://customjoygifts.com",
                    "ck" : "ck_288a3fc2bf3503385f8442ab4353392d115c296d",
                    "cs" : "cs_5a3ed2d7aac56ae7c94e0050a08a9893f9b8058f"

                }';

                return $data;
            } else {
                if($site == 'printfusionusa-editproduct.php' || $site == 'printfusionusa-editdraftproduct.php' || $site == 'printfusionusa_editdraftproduct.php' || $site == 'printfusionusa-setting.php' || $site == 'printfusionusa' || $site == 'printfusionusa-schedule-product.php') {
                    $data = '{
                        "url": "https://printfusionusa.com",
                        "ck" : "ck_470213ca3b65521e5b47e6378e06d1ca1c6c3f4e",
                        "cs" : "cs_b521322e8940d3bd83b1c58a41db9081448c4dba"

                    }';

                    return $data;
                }
            }
        }
    }
}

function getKey2($site){
    if($site == 'Themegatee') {
        $data = '{
            "url": "https://themegatee.com",
            "ck" : "ck_87beed3473355a6ace23dcbb2ae8a5493baef275",
            "cs" : "cs_c79fa1db19ed6b4940a5109d247c486bed4585cb"

        }';

        return $data;
    }
}

function getKey3($site){
    if($site == 1) {
        $data = '{
            "url": "https://themegatee.com",
            "ck" : "ck_87beed3473355a6ace23dcbb2ae8a5493baef275",
            "cs" : "cs_c79fa1db19ed6b4940a5109d247c486bed4585cb"

        }';
        return $data;
    } 
}


?>