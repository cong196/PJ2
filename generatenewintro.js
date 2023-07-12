function generatenewintro($title,$kwintro,$keywordcategory,$curPageName) {

    var title = $title;
    var kwintro = $kwintro;
    var keywordcategory = $keywordcategory;
    var curPageName = $curPageName;
    function loadlayout(){
        $('#gennewIntro-loading').css('display', 'flex');
        $('#gennewIntro').css('display', 'none');
    }
    loadlayout();
    
    $.post("generatenewintro.php", { title:title, kwintro:kwintro, keywordcategory:keywordcategory, curPageName: curPageName },
    function(data) {
        
        $('#gennewIntro-loading').css('display', 'none');
        $('#gennewIntro').css('display', 'flex');

        //console.log(data);
        while (data.includes("<p></p>") || data.includes("<p><p>") || data.includes("</p></p>") || data.includes("<p>&nbsp;</p>") ) {
            data = data.replace("<p></p>", "");
            data = data.replace("<p><p>", "<p>");
            data = data.replace("</p></p>", "</p>");
            data = data.replace("<p>&nbsp;</p>", "");
            //console.log(contentDescription);
        }
        CKEDITOR.instances['txtintropost'].setData(data);

    });

}