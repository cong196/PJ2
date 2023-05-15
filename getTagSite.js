function getTagsSite($site) {
    var site = $site;
    function ds(){
        $('#btnButtonTag').css('display', 'none');
        $('#btnButtonTag-loading').css('display', 'flex');
        //console.log('12');
    }
    function doneCSS(){
        $('#btnButtonTag').css('display', 'flex');
        $('#btnButtonTag-loading').css('display', 'none');
    }
    ds();
    $.post("getTagsSite.php", {site:site},
    function(data) {
        
        //location.reload();
        console.log(data);
        doneCSS();
    });

}