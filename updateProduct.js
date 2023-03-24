function updateproducts($id,$site) {
    var id = $id;
    var site = $site;
    var des = CKEDITOR.instances['content-'+id].getData();
    var title = $('#txttitle-' + id).val();
    function loadlayout(){
        $('#saveinfo-' + id+'loading').css('display', 'flex');
        $('#saveinfo-' + id).css('display', 'none');
    }
    loadlayout();
    
    $.post("updateProduct.php", { id:id, title:title, des:des, site: site },
    function(data) {
        
        var datatextbox = 'content-'+id;
        $('#saveinfo-' + id+'loading').css('display', 'none');
        $('#saveinfo-' + id).css('display', 'flex');

        console.log(data);
        //CKEDITOR.instances['content-'+id].setData(data + data1);
        //console.log(data);
        //$('#title' + id).val(data);
        //document.getElementById('#title'+id).value = data;
        /*for(let i = 0; i < listData.product.length; i++) {
            if(listData.product[i].id == $id){
                listData.product[i].name = data;
                break;
            }
        }*/
    });

}