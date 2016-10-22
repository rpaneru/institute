<?php 
echo $header; 
?>


<link href="extras/gallery/dist/css/lightgallery.css" rel="stylesheet">
<style type="text/css">            
    .demo-gallery > ul {
      margin-bottom: 0;
    }
    .demo-gallery > ul > li {
        float: left;
        margin-bottom: 15px;
        margin-right: 20px;
        width: 200px;
    }
    .demo-gallery > ul > li a {
      border: 3px solid #FFF;
      border-radius: 3px;
      display: block;
      overflow: hidden;
      position: relative;
      float: left;
    }
    .demo-gallery > ul > li a > img {
      -webkit-transition: -webkit-transform 0.15s ease 0s;
      -moz-transition: -moz-transform 0.15s ease 0s;
      -o-transition: -o-transform 0.15s ease 0s;
      transition: transform 0.15s ease 0s;
      -webkit-transform: scale3d(1, 1, 1);
      transform: scale3d(1, 1, 1);
      height: 100%;
      width: 100%;
    }
    .demo-gallery > ul > li a:hover > img {
      -webkit-transform: scale3d(1.1, 1.1, 1.1);
      transform: scale3d(1.1, 1.1, 1.1);
    }
    .demo-gallery > ul > li a:hover .demo-gallery-poster > img {
      opacity: 1;
    }
    .demo-gallery > ul > li a .demo-gallery-poster {
      background-color: rgba(0, 0, 0, 0.1);
      bottom: 0;
      left: 0;
      position: absolute;
      right: 0;
      top: 0;
      -webkit-transition: background-color 0.15s ease 0s;
      -o-transition: background-color 0.15s ease 0s;
      transition: background-color 0.15s ease 0s;
    }
    .demo-gallery > ul > li a .demo-gallery-poster > img {
      left: 50%;
      margin-left: -10px;
      margin-top: -10px;
      opacity: 0;
      position: absolute;
      top: 50%;
      -webkit-transition: opacity 0.3s ease 0s;
      -o-transition: opacity 0.3s ease 0s;
      transition: opacity 0.3s ease 0s;
    }
    .demo-gallery > ul > li a:hover .demo-gallery-poster {
      background-color: rgba(0, 0, 0, 0.5);
    }
    .demo-gallery .justified-gallery > a > img {
      -webkit-transition: -webkit-transform 0.15s ease 0s;
      -moz-transition: -moz-transform 0.15s ease 0s;
      -o-transition: -o-transform 0.15s ease 0s;
      transition: transform 0.15s ease 0s;
      -webkit-transform: scale3d(1, 1, 1);
      transform: scale3d(1, 1, 1);
      height: 100%;
      width: 100%;
    }
    .demo-gallery .justified-gallery > a:hover > img {
      -webkit-transform: scale3d(1.1, 1.1, 1.1);
      transform: scale3d(1.1, 1.1, 1.1);
    }
    .demo-gallery .justified-gallery > a:hover .demo-gallery-poster > img {
      opacity: 1;
    }
    .demo-gallery .justified-gallery > a .demo-gallery-poster {
      background-color: rgba(0, 0, 0, 0.1);
      bottom: 0;
      left: 0;
      position: absolute;
      right: 0;
      top: 0;
      -webkit-transition: background-color 0.15s ease 0s;
      -o-transition: background-color 0.15s ease 0s;
      transition: background-color 0.15s ease 0s;
    }
    .demo-gallery .justified-gallery > a .demo-gallery-poster > img {
      left: 50%;
      margin-left: -10px;
      margin-top: -10px;
      opacity: 0;
      position: absolute;
      top: 50%;
      -webkit-transition: opacity 0.3s ease 0s;
      -o-transition: opacity 0.3s ease 0s;
      transition: opacity 0.3s ease 0s;
    }
    .demo-gallery .justified-gallery > a:hover .demo-gallery-poster {
      background-color: rgba(0, 0, 0, 0.5);
    }
    .demo-gallery .video .demo-gallery-poster img {
      height: 48px;
      margin-left: -24px;
      margin-top: -24px;
      opacity: 0.8;
      width: 48px;
    }
    .demo-gallery.dark > ul > li a {
      border: 3px solid #04070a;
    }
    .home .demo-gallery {
      padding-bottom: 80px;
    }
</style>




<div class="demo-gallery" styel="font-color:black;">
    <ul id="lightgallery" class="list-unstyled row">       
        
        <?php        
        foreach($gallery_data as $gallery )
        {
        ?>
        <li class="col-xs-6 col-sm-4 col-md-3" data-responsive="index.php?route=common/gallery/resize&imageName=<?php echo $gallery['thumbnail'];?>&new_width=375&new_height=250 375, index.php?route=common/gallery/resize&imageName=<?php echo $gallery['thumbnail'];?>&new_width=480&new_height=320 480, index.php?route=common/gallery/resize&imageName=<?php echo $gallery['thumbnail'];?>&new_width=800&new_height=523 800" data-src="index.php?route=common/gallery/resize&imageName=<?php echo $gallery['thumbnail'];?>&new_width=1600&new_height=1066" data-sub-html="<h4><?php echo $gallery['heading'];?></h4><p><?php echo $gallery['caption'];?></p>">
            <a href="#">
                <img class="img-responsive" src="index.php?route=common/gallery/resize&imageName=<?php echo $gallery['thumbnail'];?>&new_width=348&new_height=235">
            </a>
        </li>
        <?php
        }
        ?>
        
        
    </ul>
</div>
<script type="text/javascript">

$(document).ready(function(){
    $('#lightgallery').lightGallery();
});
</script>
<script src="extras/gallery/dist/js/picturefill.min.js"></script>
<script src="extras/gallery/dist/js/lightgallery.js"></script>
<script src="extras/gallery/dist/js/lg-fullscreen.js"></script>
<script src="extras/gallery/dist/js/lg-thumbnail.js"></script>
<script src="extras/gallery/dist/js/lg-video.js"></script>
<script src="extras/gallery/dist/js/lg-autoplay.js"></script>
<script src="extras/gallery/dist/js/lg-zoom.js"></script>
<script src="extras/gallery/dist/js/lg-hash.js"></script>
<script src="extras/gallery/dist/js/lg-pager.js"></script>
<script src="extras/gallery/dist/lib/jquery.mousewheel.min.js"></script>  


<footer>
<?php 
echo $footer; 
?>