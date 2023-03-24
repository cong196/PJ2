function generateDescription($title,$id,$prompt,$urlimg) {

    var title = $title;
    var id = $id;
    var prompt = $prompt;
    var urlimg = $urlimg;
    
    function loadlayout(){
        $('#gendes-' + id+'loading').css('display', 'flex');
        $('#gendes-' + id).css('display', 'none');
    }
    loadlayout();
    
    $.post("gendescription.php", { title:title, prompt:prompt },
    function(data) {
        
        var datatextbox = 'content-'+id;
        $('#gendes-' + id+'loading').css('display', 'none');
        $('#gendes-' + id).css('display', 'flex');
        //console.log(data);
        var data1 = CKEDITOR.instances['content-'+id].getData();
        CKEDITOR.instances['content-'+id].setData(data + '<br/>' +  data1);
        
    });

}