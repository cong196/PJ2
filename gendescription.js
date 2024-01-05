
function generateDescription($title,$id,$prompt,$urlimg,$edtKeyword,$selectmainCategory,$curPageName,$slug,$edttitle,$img2,$storedValue1,$storedValueModel1,$is_add_related,$is_add_homepage) {

    var title = $title;
    var id = $id;
    var prompt = $prompt;
    var urlimg = $urlimg;
    var edtKeyword = $edtKeyword;
    var selectmainCategory = $selectmainCategory;
    var curPageName = $curPageName;
    var slug = $slug;
    var edttitle = $edttitle;
    var img2 = $img2;
    var storedValueModel1 = $storedValueModel1;
    var storedValue1 = $storedValue1;
    var isaddtoschedule = false;
    var ispublic = 0;
    var is_add_related = $is_add_related;
    var is_add_homepage = $is_add_homepage;
    if(document.getElementById('radPublish-'+id).checked) {
           ispublic = 1;
    }else if(document.getElementById('radDefault-'+id).checked) {
           ispublic = 0;
    }
    var isaddtoscheduleavailable = document.getElementById("checkaddSchedule-" + id);
    if (isaddtoscheduleavailable !== null) {
        isaddtoschedule = true;
    } else {
        isaddtoschedule = false;
    }
    function loadlayout(){
        $('#gendes-' + id+'loading').css('display', 'flex');
        $('#gendes-' + id).css('display', 'none');
    }
    loadlayout();
    
    $.post("gendescription.php", {id:id, title:title, prompt:prompt, edtKeyword:edtKeyword,is_add_related:is_add_related,is_add_homepage:is_add_homepage, selectmainCategory:selectmainCategory, curPageName:curPageName, edttitle:edttitle, storedValue:storedValue1, storedValueModel:storedValueModel1,isaddtoschedule:isaddtoschedule,ispublic:ispublic },
    function(data) {
        var datatextbox = 'content-'+id;
        $('#gendes-' + id+'loading').css('display', 'none');
        $('#gendes-' + id).css('display', 'flex');
        
        var data1 = CKEDITOR.instances['content-'+id].getData();
         var parts = data.split("BD0011");
         
         var contentDescription = '';

        if (img2 == '') {
            contentDescription = parts[0] + '<img class="aligncenter" title="' + title + '" src="' + urlimg + '" alt="' + slug + '" width="600" />' + data1 + '<p>' + parts[1] + '</p>';
        } else {
            contentDescription = parts[0] 
                + '<img class="aligncenter" title="' + title + '" src="' + urlimg + '" alt="' + slug + '" width="600" /><br/>'
                + '<img class="aligncenter" title="' + title + '" src="' + img2 + '" alt="' + slug + '" width="600" />' 
                + data1 + '<p>' + parts[1] + '</p>';
        }

        while (contentDescription.includes("<p></p>") || contentDescription.includes("<p><p>") || contentDescription.includes("</p></p>") ) {
            contentDescription = contentDescription.replace("<p></p>", "");
            contentDescription = contentDescription.replace("<p><p>", "<p>");
            contentDescription = contentDescription.replace("</p></p>", "</p>");
            //console.log(contentDescription);
        }
        CKEDITOR.instances['content-'+id].setData(contentDescription);
        updateProductDraft(id,curPageName);
    });

}