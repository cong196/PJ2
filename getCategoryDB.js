function getCategoriesDB($site) {

    var site = $site;
  
    function ds(){
        //$('#btnGencontent').css('display', 'none');
        //console.log(site);
    }
    ds();
    $.post("getCategoryDB.php", { site:site},
    function(data) {
        console.log(data);
    });

}