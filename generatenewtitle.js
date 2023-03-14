function generatenewtitle($title,$id) {

    var title = $title;
    var id = $id;
    function loadlayout(){
        $('#gennewtitle-' + id+'loading').css('display', 'flex');
        $('#gennewtitle-' + id).css('display', 'none');
        //$('#btnAddImageSLL').css('display', 'none');
        //$('#btnAddImageSLL').css('display', 'none');
        //$('#btnAddImageSLLLoading').css('display', 'flex');
    }
    loadlayout();
    
    $.post("generatenewtitle.php", { title:title },
    function(data) {
        
        //let txt = data;
        //let obj = JSON.parse(txt);
        //document.getElementById("demo").innerHTML = obj.id + ", " + obj.id;

        //console.log(obj);

        $('#gennewtitle-' + id+'loading').css('display', 'none');
        $('#gennewtitle-' + id).css('display', 'flex');

        console.log(data);
        $('#title' + id).val(data);

         //var arrid = data.slice(0, -1);
         //var ar = arrid.split(',');
        //console.log(data);
        //location.reload();
    });

}