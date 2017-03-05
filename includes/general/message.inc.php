<?php
if(isset($_GET['message']))
{
?>
<div class="row">
    <div class="container">
        <div class="col-md-12">
            <div class="alert alert-warning" role="alert">
                <?php
                echo urldecode($_GET['message']);
                ?>
            </div><!-- .alert -->
        </div><!-- .col-md-12 -->
    </div><!-- .container -->
</div><!-- .row -->
<?php
}
?>