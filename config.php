<?php

$url = '';
$ck = '';
$cs = '';
function getChatGPTKey(){
    return "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";
}

function getKey($site){
    if($site == 'themegatee-editproduct.php' || $site == 'themega-editdraftproduct.php' || $site == 'themegatee-setting.php' || $site == 'themegatee') {
        $data = '{
            "url": "https://themegatee.com",
            "ck" : "ck_87beed3473355a6ace23dcbb2ae8a5493baef275",
            "cs" : "cs_c79fa1db19ed6b4940a5109d247c486bed4585cb"

        }';

        return $data;
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