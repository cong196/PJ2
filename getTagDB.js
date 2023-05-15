function getTagDB($site) {

    var site = $site;
  
    function ds(){
        //$('#btnGencontent').css('display', 'none');
        //console.log(site);
    }
    ds();
    $.post("getTagDB.php", { site:site},
    function(data) {
        console.log(data);
    });

}