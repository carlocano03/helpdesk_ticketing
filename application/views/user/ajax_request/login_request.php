<script>
    $(document).on('submit', '#login_form', function(event){
        event.preventDefault();
        event.stopImmediatePropagation();

        $.ajax({
            url: "<?= base_url() . 'user/login_process'?>", 
            method: "POST",
            data: new FormData(this),
            dataType: "json",
            contentType:false,
            processData:false,
            success:function(data)
            {
                if(data.error != '')
                {
                    $('.message').html(data.error);
                    setTimeout(function(){
                        $('.message').html('');
                    },3000)
                }else{
                    $('.message').html(data.success);
                    setTimeout(function(){
                      $('#message').html('');
                      window.location.href = "<?= base_url() . 'main'?>";
                    },3000);
                }
            }
        });
    });
</script>