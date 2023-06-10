function getnewProductLink($site) {
    var site = $site;
    var number = $('#txtgetnewProductLink').val();
    function ds2(){
        $('#btngetnewProductLink').css('display', 'none');
        $('#btngetnewProductLink-loading').css('display', 'flex');
        //console.log('12');
    }
    function doneCSS2(){
        $('#btngetnewProductLink').css('display', 'flex');
        $('#btngetnewProductLink-loading').css('display', 'none');
    }
    ds2();
    $.post("getnewProductLink.php", {site:site, number:number},
    function(data) {
        
        //location.reload();
        console.log(data);
        doneCSS2();
    });

}