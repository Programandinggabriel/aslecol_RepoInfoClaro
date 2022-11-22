document.addEventListener('DOMContentLoaded',()=>{
    $('#bnts_load_files button').click(function(){
        let idbtn = $(this).attr('id');
        
        //alert(idbtn);
        window.location.href = 'forms/form_carga_csv.php?numFile=' + idbtn;
    });

    $('#start').click(function(){
        let xml = new XMLHttpRequest();

        xml.open('POST', './querys_create_file/info_mysqli.php');
        xml.send();
    });
},false);