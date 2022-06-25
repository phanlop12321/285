$(function(){
    var CODE1Object = $('#ID_CODE');
    var case_IDObject = $('#case_ID');
    
    // on change province
    CODE1Object.on('change', function(){
        var code_1 = $(this).val();
        

        case_IDObject.html('<option value="">เลือกสภาพภูมิประเทศ</option>');

        $.get('get_case.php?case_ID=' + code_1, function(data){
            var result = JSON.parse(data);
            console.log(result)
            $.each(result, function(index, item){
                case_IDObject.append(
                    $('<option></option>').val(item.AT).html(item.AT_NAME)
                );
            });
        });
    });

});