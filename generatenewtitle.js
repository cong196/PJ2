function generatenewtitle($title,$id) {

    var title = $title;
    var id = $id;
    function loadlayout(){
        $('#gennewtitle-' + id+'loading').css('display', 'flex');
        $('#gennewtitle-' + id).css('display', 'none');
    }
    loadlayout();
    
    $.post("generatenewtitle.php", { title:title },
    function(data) {
    
        $('#gennewtitle-' + id+'loading').css('display', 'none');
        $('#gennewtitle-' + id).css('display', 'flex');
        //console.log(data);
        $('#title' + id).val(data);
        //document.getElementById('#title'+id).value = data;
        /*for(let i = 0; i < listData.product.length; i++) {
            if(listData.product[i].id == $id){
                listData.product[i].name = data;
                break;
            }
        }*/
    });

}