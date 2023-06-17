function updateProductDraft($id,$site) {
    var id = $id;
    var site = $site;
    var des = CKEDITOR.instances['content-'+id].getData();
    var title = $('#txttitle-' + id).val();
    var slug = $('#txtslug-' + id).val();
    var selectCategory = $('#selectCategoryyy-' + id).val();
    //alert(selectCategory);
    //console.log(selectCategory);
    var lscv = selectCategory.toString();
    var selectTag1 = $('#listTag-' + id).val();
    var selectTag2 = selectTag1.toString();

    var pls = 0;
    if(document.getElementById('radPublish-'+id).checked) {
           pls = 1;
    }else if(document.getElementById('radDefault-'+id).checked) {
           pls = 0;
    }

    //console.log(selectTag2);
    function loadlayout(){
        $('#saveinfo-' + id+'loading').css('display', 'flex');
        $('#saveinfo-' + id).css('display', 'none');
    }
    loadlayout();
    
    $.post("updateProductDraft.php", { id:id, title:title, des:des, site: site , category:lscv, publishss:pls, selectTag:selectTag2, slug:slug},
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