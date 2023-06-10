function getProductLink($site) {
    var site = $site;
    function ds2(){
        $('#btngetProductLink').css('display', 'none');
        $('#btngetProductLink-loading').css('display', 'flex');
        //console.log('12');
    }
    function doneCSS2(){
        $('#btngetProductLink').css('display', 'flex');
        $('#btngetProductLink-loading').css('display', 'none');
    }
    ds2();
    $.post("getProductLink.php", {site:site},
    function(data) {
        
        //location.reload();
        //console.log(data);
        doneCSS2();
    });

}