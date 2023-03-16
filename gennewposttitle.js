function generatenewPosttitle($title) {

    var title = $title;
    function loadlayout(){
        $('#gennewtitlepost-loading').css('display', 'flex');
        $('#gennewtitlepost').css('display', 'none');
    }
    loadlayout();
    
    $.post("generatenewPosttitle.php", { title:title },
    function(data) {
    
        $('#gennewtitlepost-loading').css('display', 'none');
        $('#gennewtitlepost').css('display', 'flex');

        //console.log(data);
        $('#txtposttitle').val(data);
    });

}