function getCategoriesSite($site) {
    var site = $site;
    function ds(){
        $('#btnButton').css('display', 'none');
        $('#btnButton-loading').css('display', 'flex');
        //console.log('12');
    }
    function doneCSS(){
        $('#btnButton').css('display', 'flex');
        $('#btnButton-loading').css('display', 'none');
    }
    ds();
    $.post("getCategorySite.php", {site:site},
    function(data) {
        
        //location.reload();
        //console.log(data);
        doneCSS();
    });

}