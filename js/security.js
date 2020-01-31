$( document ).ready()
{
    function zabezpecit() {
        let ch = sha256(sha256($('input[name="password"]').val()) + $('#cas').val());
        $('#casch').append('<input type=hidden name="pwd" value="'+ch+'">');
        $('input[name="password"]').attr('disabled', 'disabled');
        $('#cas').attr('disabled', 'disabled');
        return true;
    }
}