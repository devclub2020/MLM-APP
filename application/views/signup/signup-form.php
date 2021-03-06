<script type="text/javascript">

    var xmlhttp = false;
    try {
        xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
    } catch (e) {
        try {
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        } catch (E) {
            xmlhttp = false;
        }
    }
    if (!xmlhttp && typeof XMLHttpRequest != 'undefined') {
        xmlhttp = new XMLHttpRequest();
    }
    
    function makerequest(level_one_pin, objID) {

        serverPage = '<?php echo base_url() ?>Welcome/level_one_check/' + level_one_pin;
        xmlhttp.open("GET", serverPage);
        xmlhttp.onreadystatechange = function () {

            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {

                document.getElementById(objID).innerHTML = xmlhttp.responseText;

                if (xmlhttp.responseText == "Please Enter Your Screct PIN Code") {
                    document.getElementById('dis-btn').disabled = true;
                }
                if (xmlhttp.responseText == 'Your input PIN not correct ! Please Enter a valid pin code') {
                    document.getElementById('dis-btn').disabled = true;
                }
                if (xmlhttp.responseText == '') {
                    document.getElementById('dis-btn').disabled = false;
                }
            }
        }
        xmlhttp.send(null);
    }
    function makerequest(log_name, objID) {

        serverPage = '<?php echo base_url() ?>Welcome/user_name_check/' + log_name;
        xmlhttp.open("GET", serverPage);
        xmlhttp.onreadystatechange = function () {

            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {

                document.getElementById(objID).innerHTML = xmlhttp.responseText;

                if (xmlhttp.responseText == "Please Enter Your User Name") {
                    document.getElementById('dis-btn').disabled = true;
                }
                if (xmlhttp.responseText == 'This User Name Already Exists') {
                    document.getElementById('dis-btn').disabled = true;
                }
                if (xmlhttp.responseText == '') {
                    document.getElementById('dis-btn').disabled = false;
                }
            }
        }
        xmlhttp.send(null);
    }
    
</script>


<div id="login-page">
    <div class="container">

        <form class="form-login form-signup" action="<?php echo base_url() ?>Welcome/createNewAccount" method="post" enctype="multipart/form-data" style="max-width:500px;margin-top: 0;">
            <h2 class="form-login-heading">sign in now</h2>
            <!-- Error For blank Input -->
            <?php 
                $gap = $this->session->userdata('gap');
                if($gap){
            ?>
            <p class="text-center text-danger"><?php echo $gap; $this->session->unset_userdata('gap');?></p>
            <?php }?>
            <!-- Error message for User Name and Password -->
                <?php 
                    $emailpassword = $this->session->userdata('emailpass');
                    if($emailpassword){
                ?>
                <h5 style="color:red" class="text-center">
                <?php 
                    echo $emailpassword; 
                    $this->session->unset_userdata('emailpass');
                ?>
                </h5>
                <?php }?>
                <!-- Error message for image  -->
                <h5 style="color:red">
                     <?php
                     $img_error = $this->session->userdata('img_error');
                     if ($img_error) { ?>
                 <?php
                 $img_error = $this->session->userdata('img_error');
                 if ($img_error) { ?>
                     <h5 style="color:red">
                      <?php
                          echo $img_error;
                          $this->session->unset_userdata('img_error');
                     }
                     ?>
                 </h5>
                       ?>
                     </h5>
                 <?php }?>
             <!--END Error message for image -->
                <div class="login-wrap">
                <input type="text" class="form-control" placeholder="Full Name*" name="u_name" required="">
                <br>
                <input type="text" class="form-control" placeholder="Father Name" name="u_father_name" required="">
                <br/>
                <input type="email" class="form-control" placeholder="Email*" name="u_email" required="">
                <br/>
                <input type="number" class="form-control" placeholder="National ID No*" name="u_nid" required="">
                <br/>
                <input type="date" class="form-control" placeholder="Date OF Birth*" name="u_birth" required="">
                <br/>
                <input type="number" class="form-control" placeholder="Mobile*" name="u_mobile" required="">
                <br/>
                <input type="text" class="form-control" placeholder="Gender*" name="u_gender" required="">
                <br/>
                <textarea class="form-control" placeholder="Address" name="u_address" required=""></textarea>
                <br/>
                <div>
                <select id="country" name="country" class="form-control"></select>
                    <script language="javascript">
                        populateCountries("country");
                    </script>
                </div>
                <br>
                <input type="text" pattern=".{5,18}" class="form-control" placeholder="User Name" name="log_name" required title="5 to 18 characters" onblur="makerequest(this.value, 'result2')">
                <span id="result2" style="color:red; padding: 20px 10px !important"></span>
                <br>
                <input type="password" class="form-control" placeholder="Password*" name="u_password" required="">
            <!-- Error message for Email and Password -->
                <p style="margin: 0px;color:#008000;font-size: 12px;">
                    * 1 lower case letter [a-z] and 1 upper case letter [A-Z] and 1 numeric character [0-9] and must be 8 characters
                </p>
                <br>
                <input type="file" class="form-control" placeholder="image*" name="u_img" required="">
                <br/>
                <input type="text" class="form-control" placeholder="Pin Code*" name="level_one_pin" required="" onblur="makerequest(this.value, 'result')">
                <span id="result" style="color:red; padding: 20px 10px !important"></span>
                <span style="color:#F00; padding: 20px 10px !important">
                    <?php 
                        $error=$this->session->userdata('pin_mess');
                        if($error){
                            echo $error;
                            $this->session->unset_userdata('pin_mess');
                        }
                    ?>
                </span>
                <br/>
                <input type="hidden" name="u_entry_date" value="<?php echo date('Y-m-d')?>">
                <br/>

                <button class="btn btn-theme btn-block" id="dis-btn" type="submit"><i class="fa fa-lock"></i> SIGN IN</button>
                <hr>

                <div class="registration">
                    Go back to Home page <br/>
                    <a class="" href="<?php echo base_url() ?>">
                        Home
                    </a>
                </div>

            </div>
        </form>	  	

    </div>
</div>
