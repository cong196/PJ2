function generateDescription($title,$id,$prompt,$urlimg,$edtKeyword,$selectmainCategory,$curPageName) {

    var title = $title;
    var id = $id;
    var prompt = $prompt;
    var urlimg = $urlimg;
    var edtKeyword = $edtKeyword;
    var selectmainCategory = $selectmainCategory;
    var curPageName = $curPageName;

    console.log(selectmainCategory);

    function loadlayout(){
        $('#gendes-' + id+'loading').css('display', 'flex');
        $('#gendes-' + id).css('display', 'none');
    }
    loadlayout();
    
    $.post("gendescription.php", { title:title, prompt:prompt, edtKeyword:edtKeyword, selectmainCategory:selectmainCategory, curPageName:curPageName },
    function(data) {
        var datatextbox = 'content-'+id;
        $('#gendes-' + id+'loading').css('display', 'none');
        $('#gendes-' + id).css('display', 'flex');
        //console.log(data);
        var data1 = CKEDITOR.instances['content-'+id].getData();
        var parts = data.split("BD0011");
        CKEDITOR.instances['content-'+id].setData(parts[0] + '<img class="alignnone" title="' + title + '" src=" '+ urlimg +' " alt="' + title + '" width="600" />' +  data1 + '<p>' + parts[1] + '</p>');

    });

}