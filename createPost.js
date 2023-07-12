function createPostJS($title,$content,$urlimg,$imageId,$selectPostCategory) {

    var content = $content;
    var title = $title;
    var urlimg = $urlimg;
    var imageId = $imageId;
    var selectPostCat = $selectPostCategory;
    var selectPostCategory = selectPostCat.join(',');
    function ds(){
       $('#btnCreatePost').css('display', 'none');
       $('#btncloseModal').css('display', 'none');
       $('#loading-btnCreatePost').css('display', 'flex');
       $('#txtResult').css('display', 'none');
       console.log(selectPostCategory);
    }
    ds();

    $.post("createpost.php", { content: content, title:title, urlimg: urlimg, imageId: imageId, selectPostCategory: selectPostCategory},
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

        console.log(data);
    });

}