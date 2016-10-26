<?php 
echo $header;
echo $column_left; 
?>
<div id="content">
    
    <div class="page-header">
        <div class="container-fluid">
            <div class="pull-right">
                <button type="submit" form="form-user" data-toggle="tooltip" title="<?php echo $button_save; ?>" class="btn btn-primary"><i class="fa fa-save"></i></button>
                <a href="<?php echo $cancel; ?>" data-toggle="tooltip" title="<?php echo $button_cancel; ?>" class="btn btn-default"><i class="fa fa-reply"></i></a>
            </div>
            <h1><?php echo $heading_title; ?></h1>
            <ul class="breadcrumb">
                <?php foreach ($breadcrumbs as $breadcrumb) 
                { 
                ?>
                    <li><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a></li>
                <?php 
                } 
                ?>
            </ul>
        </div>
    </div>
    
    <div class="container-fluid">
    <?php 
    if ($error_warning) 
    { 
    ?>
        <div class="alert alert-danger"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?>
            <button type="button" class="close" data-dismiss="alert">&times;</button>
        </div>
    <?php 
    } 
    ?>
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-pencil"></i> <?php echo $text_form; ?></h3>
            </div>
            <div class="panel-body">
                <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="form-user" class="form-horizontal">
                    
                    <div class="form-group required">
                        <label class="col-sm-2 control-label" for="input-heading"><?php echo $entry_heading; ?></label>
                        <div class="col-sm-10">
                            <input type="text" name="heading" value="<?php echo $heading; ?>" placeholder="<?php echo $entry_heading; ?>" id="input-heading" class="form-control" />
                            <?php 
                            if ($error_heading) 
                            { 
                            ?>
                                <div class="text-danger"><?php echo $error_heading; ?></div>
                            <?php 
                            } 
                            ?>
                        </div>
                    </div>    
                    
                    
                    <div class="form-group required">
                        <label class="col-sm-2 control-label" for="input-caption"><?php echo $entry_caption; ?></label>
                        <div class="col-sm-10">
                            <input type="text" name="caption" value="<?php echo $caption; ?>" placeholder="<?php echo $entry_caption; ?>" id="input-caption" class="form-control" />
                            <?php 
                            if ($error_caption) 
                            { 
                            ?>
                                <div class="text-danger"><?php echo $error_caption; ?></div>
                            <?php 
                            } 
                            ?>
                        </div>
                    </div>
                             
                </form>
            </div>
        </div>
    </div>
</div>
<?php 
echo $footer; 
?> 