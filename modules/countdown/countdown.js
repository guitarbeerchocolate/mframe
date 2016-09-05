$('.message').change(updateCountdown);
$('.message').keyup(updateCountdown);
function updateCountdown()
{
    var remaining = 1000 - $('.message').val().length;
    $('.countdown').text(remaining + ' characters remaining.');
}