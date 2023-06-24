function generateDescription($title,$id,$prompt,$urlimg,$edtKeyword,$selectmainCategory,$curPageName,$slug,$edttitle,$img2) {

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
    function loadlayout(){
        $('#gendes-' + id+'loading').css('display', 'flex');
        $('#gendes-' + id).css('display', 'none');
    }
    loadlayout();
    
    $.post("gendescription.php", { title:title, prompt:prompt, edtKeyword:edtKeyword, selectmainCategory:selectmainCategory, curPageName:curPageName, edttitle:edttitle},
    function(data) {
        var datatextbox = 'content-'+id;
        $('#gendes-' + id+'loading').css('display', 'none');
        $('#gendes-' + id).css('display', 'flex');
        //console.log(data);
        /*var data1 = CKEDITOR.instances['content-'+id].getData();
        var parts = data.split("BD0011");
        CKEDITOR.instances['content-'+id].setData(parts[0] + '<img class="aligncenter" title="' + title + '" src=" '+ urlimg +' " alt="' + slug + '" width="600" />' +  data1 + '<p>' + parts[1] + '</p>');
*/
        var data1 = CKEDITOR.instances['content-'+id].getData();
         var parts = data.split("BD0011");
         /*var contentDescription = parts[0] + '<img class="aligncenter" title="' + title + '" src=" '+ urlimg +' " alt="' + slug + '" width="600" />' +  data1 + '<p>' + parts[1] + '</p>';
        */
         var contentDescription = '';
         if(img2 == '') {
            contentDescription = parts[0] + '<img class="aligncenter" title="' + title + '" src=" '+ urlimg +' " alt="' + slug + '" width="600" />' +  data1 + '<p>' + parts[1] + '</p>';
         } else {
            contentDescription = parts[0] + '<img class="aligncenter" title="' + title + '" src=" '+ urlimg +' " alt="' + slug + '" width="600" /><br/>'
                + '<img class="aligncenter" title="' + title + '"src=" '+ img2 +' " alt="' + slug + '" width="600" />' +  data1 + '<p>' + parts[1] + '</p>';
         }

        while (contentDescription.includes("<p></p>") || contentDescription.includes("<p><p>") || contentDescription.includes("</p></p>") ) {
            contentDescription = contentDescription.replace("<p></p>", "");
            contentDescription = contentDescription.replace("<p><p>", "<p>");
            contentDescription = contentDescription.replace("</p></p>", "</p>");
            //console.log(contentDescription);
        }
        CKEDITOR.instances['content-'+id].setData(contentDescription);

    });

}