<?php 
echo $header; 
?>

<style>    
.inputcaptcha{
	width: 120px !important;
	float: left;
}

.imgcaptcha{
    border: 1px solid #CCCCCC;
    border-radius: 5px;
    margin: 0px 10px;
    float: left;
    
}

.refresh{
	float: left;
	margin: 14px 5px;
	cursor: pointer;
}
    
</style>

<section id="contact">
    <div class="contact-page">
        <div class="container">
            
            <div class="map col-md-12">
                <div class="col-md-4 " >
                    <h3>CONTACT INFO</h3>
                    <ul>
                        <li><i class="fa fa-home fa-2x addressIcons"></i> <label class="addressLbl">Office # 38, Suite 54 Elizebth Street,<br > Victoria State Newyork, USA 33026</label></li>
                        <li><i class="fa fa-phone fa-2x addressIcons"></i> <label class="addressLbl">+38 000 129900</label></li>
                        <li><i class="fa fa-envelope fa-2x addressIcons"></i> <label class="addressLbl">info@domain.net</label></li>
                    </ul>

                </div>
                <div class="col-md-8">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3508.188037692613!2d77.00894785023006!3d28.443747499265825!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390d182052140977%3A0x7d842f8cae154adc!2sKhandsa+Rd%2C+Sector+10A%2C+Gurgaon%2C+Haryana!5e0!3m2!1sen!2sin!4v1476613912367" width="600" height="250" frameborder="0" style="border:0" allowfullscreen></iframe>
                </div>
            </div>

            <div class="center">        
                <h3>Send Your Query</h3>						
            </div> 
            
        <?php
        if(count($errro_message) > 0)
        {        
        ?>
        <div class="alert alert-danger" role="alert">
          <strong>ERROR!</strong> 
          <ul>
            <?php
            $i = 0;
            $count = count($errro_message);
            while($i < $count)
            {
            ?>
            <li><?php echo $errro_message[$i]; ?></li>
            <?php 
              $i++;
            }
            ?>          
          </ul>
        </div>
        <?php
        }
        if(count($success_message) > 0)
        {        
        ?>
        <div class="alert alert-success" role="alert">
          <strong>SUCCESS!</strong> 
          <ul>
            <?php
            $i = 0;
            $count = count($success_message);
            while($i < $count)
            {
            ?>
            <li><?php echo $success_message[$i]; ?></li>
            <?php 
              $i++;
            }
            ?>          
          </ul>
        </div>
        <?php
        }
        ?>
				
            <div class="row contact-wrap">						
                <div class="status alert alert-success" style="display: none"></div>
                
                <form id="main-contact-form" class="contact-form" name="contact-form" method="post" action="index.php?route=common/contact">
                    <div class="wow fadeInDown">
                        <div class="col-sm-5 col-sm-offset-1">
                            <div class="form-group">
                                <label class="queryLbl">Name *</label>
                                <input value="<?php echo $name; ?>" type="text" name="name" class="form-control" required="required">
                            </div>
                            <div class="form-group">
                                <label class="queryLbl">Email *</label>
                                <input value="<?php echo $email; ?>" type="email" name="email" class="form-control" required="required">
                            </div>
                            <div class="form-group">
                                <label class="queryLbl">Mobile *</label>
                                <input value="<?php echo $mobile; ?>" name="mobile" type="text" pattern="[7-9]{1}[0-9]{9}" class="form-control" required="required">
                            </div> 
                            <div class="form-group">
                                <label class="queryLbl">Subject *</label>
                                <input value="<?php echo $subject; ?>" type="text" name="subject" class="form-control" required="required">
                            </div>                            
                        </div>
                    </div>
                    <div class="wow fadeInRight">
                        <div class="col-sm-5">                            
                            <div class="form-group">
                                <label class="queryLbl">Message *</label>
                                <textarea name="message" id="message" required="required" class="form-control" rows="8"><?php echo $message; ?></textarea>
                            </div>  
                            <div class="form-group">
                                <label class="queryLbl">Captcha *</label>                                
                            </div>                            
                            <input type="text" placeholder="Enter Code" id="captcha" name="captcha" class="form-control inputcaptcha" required="required">
                            <img src="index.php?route=common/contact/get-captcha-image" class="imgcaptcha" alt="captcha"  />
                            <img src="extras/images/refresh.png" alt="reload" class="refresh" />
                                
                            <div class="form-group">
                                <button type="submit" name="submit" class="btn btn-primary btn-lg" required="required">Submit Message</button>
                            </div>
                        </div>
                    </div>
                </form> 
            </div>
            
        </div>
    
        
    </div>    
</section>

                            
<script language="javascript">
$(document).ready(function(){

    $(".refresh").click(function () {
        $(".imgcaptcha").attr("src","index.php?route=common/contact/get-captcha-image");

    });

});
</script>
	
<?php 
echo $footer; 
?>