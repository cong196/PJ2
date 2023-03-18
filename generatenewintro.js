function generatenewintro($title) {

    var title = $title;
    function loadlayout(){
        $('#gennewIntro-loading').css('display', 'flex');
        $('#gennewIntro').css('display', 'none');
    }
    loadlayout();
    
    $.post("generatenewintro.php", { title:title },
    function(data) {
    
        $('#gennewIntro-loading').css('display', 'none');
        $('#gennewIntro').css('display', 'flex');

        //console.log(data);
        $('#txtintropost').val(data);
    });

}