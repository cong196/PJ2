<?php

$url = '';
$ck = '';
$cs = '';
function getChatGPTKey(){
    //return "";
    return "";
}

function getKey($site){
    if($site == 'themegatee-editproduct.php' || $site == 'themega-editdraftproduct.php' || $site == 'themega_editdraftproduct.php' || $site == 'themegatee-setting.php' || $site == 'themegatee') {
        $data = '{
            "url": "https://themegatee.com",
            "ck" : "ck_87beed3473355a6ace23dcbb2ae8a5493baef275",
            "cs" : "cs_c79fa1db19ed6b4940a5109d247c486bed4585cb"

        }';

        return $data;
    } else {
        if($site == 'kacogifts-editproduct.php' || $site == 'kacogifts-editdraftproduct.php' || $site == 'kacogifts_editdraftproduct.php' || $site == 'kacogifts-setting.php' || $site == 'kacogifts') {
             $data = '{
                "url": "https://kacogifts.com",
                "ck" : "ck_26e2b0b45e5b19190e5dc0504002cca4cd7702a8",
                "cs" : "cs_0eddf1d7b6b651f47bce09f09aad3262e3294e3f"
            }';

            return $data;
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