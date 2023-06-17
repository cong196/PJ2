function jsProduct($btn,$site,$id) {

    /*var title = $title;
    var id = $id;*/
    var id = $id;
    var site = $site;
    function loadlayout(){
        $('#btnYesDel-' + $id).css('display', 'none');
        $('#savedelete-' + $id + 'loading').css('display', 'flex');
        $('#delete-' + $id).css('display', 'none');
    }
    function load2() {
        var row = $btn.parentNode.parentNode;
        row.parentNode.removeChild(row);
    }
    function loadlayout1(){
        $('#btnYesDel-' + $id).css('display', 'none');
        $('#savedelete-' + $id + 'loading').css('display', 'none');
        $('#delete-' + $id).css('display', 'flex');
    }
    loadlayout();

    $.post("deleteProduct.php", { id:id, site:site },
    function(data) {

        //load2();
        if(data == 1) {
            load2();
        } else {
            alert('Lỗi rồi !');
        }

        //console.log(data);
        //alert(data);
    });

}