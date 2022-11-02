<script>
    $(document).on('submit', '#register_form', function(event) {
        event.preventDefault();
        event.stopImmediatePropagation();

        $.ajax({
            url: "<?= base_url() . 'user/account_register' ?>",
            method: "POST",
            data: new FormData(this),
            dataType: 'json',
            contentType: false,
            processData: false,
            success: function(data) {
                if (data.message != '') {
                    Swal.fire('Warning!', 'Account already exist.', 'warning');
                } else {
                    Swal.fire(
                        'Thank you!',
                        'Account successfully created. Please check your email to verify your account!',
                        'success'
                    );
                    setTimeout(function() {
                        window.location.href = "<?= base_url('user') ?>"
                    }, 2000);
                }
            },
            error: function() {
                Swal.fire('Error!', 'Something went wrong. Please try again later!', 'error');
            }
        });
    });

    function checkPasswordMatch() {
        var password = $("#yourPassword").val();
        var confirmPassword = $("#confirmPassword").val();
        if (password != confirmPassword) {
            $("#error-message").text("Passwords does not match!");
            $("#error-message").removeClass("alert alert-success");
            $("#error-message").addClass("alert alert-danger");
            $("#register_btn").attr("disabled", true);
        } else {
            $("#error-message").text("Passwords match.");
            $("#error-message").removeClass("alert alert-danger");
            $("#error-message").addClass("alert alert-success");
            $("#register_btn").attr("disabled", false);
        }
    }

    $(document).ready(function() {
        var password = $("#yourPassword").val();
        $("#confirmPassword").keyup(checkPasswordMatch);
    });
    $(document).on('keyup', '#yourPassword, #confirmPassword', function() {
        if ($(this).val() == '') {
            $("#error-message").text("");
            $("#error-message").removeClass("alert alert-danger");
            $("#error-message").removeClass("alert alert-success");
        }
    });
</script>