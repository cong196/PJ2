function genContent($title,$id) {

    var title = $title;
    var id = $id;
    function loadlayout(){
        $('#gennewcontent-' + id+'loading').css('display', 'flex');
        $('#gennewcontent' + id).css('display', 'none');
    }
    loadlayout();
    
    $.post("generatenewcontent.php", { title:title },
    function(data2) {

        $('#gennewcontent-' + id+'loading').css('display', 'none');
        $('#gennewcontent' + id).css('display', 'flex');

        /*for(let i1 = 0; i1 < listData.product.length; i1++) {
            if(listData.product[i1].id == $id){
                listData.product[i1].content = data2;
                break;
            }
        }*/
      
        $('#content' + id).val(data2);
    });

}