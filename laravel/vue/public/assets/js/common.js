
$(document).ready(function(){
	$('.validfield').keyup(function(){
        var yourInput = $(this).val();
        re = /[-`~!@#$%^&*()_|+\=?;:'",.1234567890<>\{\}\[\]\\\/]/gi;
        var isSplChar = re.test(yourInput);
        if(isSplChar){
            var no_spl_char = yourInput.replace(/[-`~!@#$%^&*()_|+\=?;:'",.1234567890<>\{\}\[\]\\\/]/gi, '');
            $(this).val(no_spl_char);
        }
    });
    $('.validateYear').keyup(function(){
        var yourInput = $(this).val();
        re = /[-`~!@#$%^&*()_|+\=?;:'",.1234567890abcdefghijkhmnopqrstuvwxyz<>\{\}\[\]\\\/]/gi;
        var isSplChar = re.test(yourInput);
        if(isSplChar){
            var no_spl_char = yourInput.replace(/[-`~!@#$%^&*()_|+\=?;:'",.1234567890abcdefghijkhmnopqrstuvwxyz<>\{\}\[\]\\\/]/gi, '');
            $(this).val(no_spl_char);
        }
    });
    $('.validatetextarea').keyup(function(){
        var yourInput = $(this).val();
        re = /[-`~!@#$%^&*()_|+\=?;:'",.<>\{\}\[\]\\\/]/gi;
        var isSplChar = re.test(yourInput);
        if(isSplChar){
            var no_spl_char = yourInput.replace(/[-`~!@#$%^&*()_|+\=?;:'",.<>\{\}\[\]\\\/]/gi, '');
            $(this).val(no_spl_char);
        }
    });
    $('.validfieldnumber').keyup(function(){
        var yourInput = $(this).val();
        re = /[-`~!@#$%^&*()_|+\=?;:'",.abcdefghijkhmnopqrstuvwxyz<>\{\}\[\]\\\/]/gi;
        var isSplChar = re.test(yourInput);
        if(isSplChar){
            var no_spl_char = yourInput.replace(/[-`~!@#$%^&*()_|+\=?;:'",.abcdefghijkhmnopqrstuvwxyz<>\{\}\[\]\\\/]/gi, '');
            $(this).val(no_spl_char);
        }
    });

    // Enter only Alphabets

    $('.nonumeric').keyup(function(){
        var yourInput = $(this).val();
        re = /[`~!@#$%^&*()_|+\=?;:'",.1234567890<>\{\}\[\]\\\/]/gi;
        var isSplChar = re.test(yourInput);
        if(isSplChar){
            var no_spl_char = yourInput.replace(/[`~!@#$%^&*()_|+\=?;:'",.1234567890<>\{\}\[\]\\\/]/gi, '');
            $(this).val(no_spl_char);
        }
    });

    $.validator.addMethod("customemail", 
	    function(value, element) {
	        return /^\w+([-+.']\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/.test(value);
	    }, 
	    "Sorry, I've enabled very strict email validation"
	);



   

       

     
});

//Populate the dropdown
        function fetchOptionDropDown(table,field,wherefld,whereval,element){
            $.ajax({
                type: 'POST',
                url: SITE_URL+'/fetchOptionDropDown',
                data: {
                    table:table,
                    field:field,
                    wherefld:wherefld,
                    whereval:whereval,
                },
                success: function(response){
                    console.log();
                    $('select[name="'+element+'"]').html(response);
                }
            });
        }
    //Populate the dropdown



       
