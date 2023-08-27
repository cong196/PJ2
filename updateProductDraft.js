function updateProductDraft($id,$site) {
    var id = $id;
    var site = $site;
    var des = CKEDITOR.instances['content-'+id].getData();
    var title = $('#txttitle-' + id).val();
    var slug = $('#txtslug-' + id).val();
    var selectCategory = $('#selectCategoryyy-' + id).val();
    var lscv = selectCategory.toString();
    var selectTag1 = $('#listTag-' + id).val();
    var selectTag2 = selectTag1.toString();
    var isCustomkeywords = 0;
    var isSavekeywords = 0;
    var keyword = "";
    var keywordvolume = 0;
    var keywordtype = "general";
    var categoryKeyword = "";
    var isCustomkeywords1 = $('#switchkeyword-' + id).prop('checked');
    if (isCustomkeywords1) {
        isCustomkeywords = 1;
        var isSavekeywords1 = $('#switchsavekeywords-' + id).prop('checked');
        if(isSavekeywords1) {
            isSavekeywords = 1;
            keyword = $('#edtKeyword-'+ id).val();
            categoryKeyword = $('#mainCategory-' + id).find('option:selected').text();
            var keywordvl = $('#txtkeywordvolume-'+ id).val();
            if(keywordvl == "") {
                keywordvolume = 0;
            } else {
                keywordvolume = keywordvl;
            }
            var keywordtp = $('#txtkeywordtype-'+ id).val();
            if(keywordtp != "") {
                keywordtype = keywordtp;
            }
        }
    }

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
    
    $.post("updateProductDraft.php", { id:id, title:title, des:des, site: site , category:lscv, publishss:pls, selectTag:selectTag2, slug:slug, isCustomkeywords:isCustomkeywords,isSavekeywords:isSavekeywords,
                                        keyword:keyword, keywordvolume:keywordvolume,keywordtype:keywordtype,categoryKeyword:categoryKeyword},
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