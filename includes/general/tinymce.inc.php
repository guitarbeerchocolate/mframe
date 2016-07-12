<?php
if($status == 'manager')
{
?>
<script src='modules/tinymce/tinymce.min.js'></script>
<script>
tinymce.init({
	selector: '.tinymce',
	menubar: false,
	plugins: ["advlist autolink lists link image charmap print preview anchor",
	"searchreplace visualblocks code fullscreen","insertdatetime media table contextmenu paste jbimages"],
	toolbar: "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image jbimages",  
	relative_urls: true
});
</script>
<?php
}
?>