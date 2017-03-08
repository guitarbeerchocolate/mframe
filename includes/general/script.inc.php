<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
<?php
if($liveConfig['status'] == 'manager')
{
?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.6.4/js/bootstrap-datepicker.min.js"></script>
<script>
(function()
{
    if($(this).hasClass('tinymce'))
    {
        tinyMCE.triggerSave();
    }
    $('.datepicker').datepicker(
    {
        format:'yyyy-mm-dd'
    });
})();
</script>
<?php
}
?>
<script src="js-cache.php"></script>