function getPostcategory($site) {
    var site = $site;
    function ds(){
        $('#btnButtonPostcategory').css('display', 'none');
        $('#btnButtonPostcategory-loading').css('display', 'flex');
        //console.log('12');
    }
    function doneCSS(){
        $('#btnButtonPostcategory').css('display', 'flex');
        $('#btnButtonPostcategory-loading').css('display', 'none');
    }
    ds();
    $.post("getPostcategory.php", { site:site },
    function(data) {
        
        //location.reload();
        console.log(data);
        doneCSS();
    });
}