function createPostJS($title,$content,$urlimg) {

    var content = $content;
    var title = $title;
    var urlimg = $urlimg;
    function ds(){
       $('#btnCreatePost').css('display', 'none');
       $('#btncloseModal').css('display', 'none');
       $('#loading-btnCreatePost').css('display', 'flex');
       $('#txtResult').css('display', 'none');
    }
    ds();

    $.post("createpost.php", { content: content, title:title, urlimg: urlimg },
    function(data) {
        //console.log(data);
        if(data == '0') { //Lỗi
            $('#txtResult').css('color', 'red');
            $('#txtResult').css('display', 'flex');
            $('#txtResult').html('<b>Error - Failed to create a new post</b>');
            $('#btnCreatePost').css('display', 'flex');
            $('#btncloseModal').css('display', 'flex');
            $('#loading-btnCreatePost').css('display', 'none');

        } else {
            $('#txtResult').css('color', 'green');
            $('#txtResult').css('display', 'flex');
            $('#txtResult').html('<b>The post ' + $title + ' has been created successfully</b>');
            $('#btnCreatePost').css('display', 'flex');
            $('#btncloseModal').css('display', 'flex');
            $('#loading-btnCreatePost').css('display', 'none');
            
        }
    });

}