$(function () {

    $('#select-shanyrak').change(function (e) { 
        e.preventDefault();
        
        $('#select-grade').val('');

        $('#form-main').submit();
    });

    $('#select-grade').change(function (e) { 
        e.preventDefault();
        
        $('#select-student').val('');

        $('#form-main').submit();
    });

    $('#select-student').change(function (e) { 
        e.preventDefault();

        $('#select-category').val('');

        $('#form-main').submit();
    });

    $('#select-category').change(function (e) { 
        e.preventDefault();

        $('#select-place').val('');

        $('#form-main').submit();
    });

    $('#select-place').change(function (e) { 
        e.preventDefault();
        
        $('#select-type').val('');

        $('#form-main').submit();
    });

    $('#select-type').change(function (e) { 
        e.preventDefault();

        $('input[name="participants_amount"]').val('');

        $('#form-main').submit();
    });

    $('input[name="participants_amount"]').keydown(function (e) {  
        $('.gallery-create-images').parent().show(); 
    });

    $('.gallery-create-images').imageUploader({
        label: 'Выберите изображения или перетащите сюда'
    });


    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
    
            document.querySelector(this.getAttribute('href')).scrollIntoView({
                behavior: 'smooth'
            });
        });
    });
});