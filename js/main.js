$('#bnts_load_files button').click(function(){
    let idbtn = $(this).attr('id');
    
    //alert(idbtn);
    window.location.href = 'forms/form_carga_csv.php?numFile=' + idbtn;
});