<div style="width:600px; overflow:hidden;">
    <div style="width:546px; margin:auto; text-align:left">
    <img src="<?=WEB_ROOT?>/img/third_step.jpg" alt="" title="" />
    <span style="color:#009cb9; font-size:14px; font-family:Calibri;">
    Create an account so that your resume is saved</span><br />
    <span style="font-size:11px; line-height:14px; font-family:Arial;">
    You will recieve free career tips, job alerts that match your profile and information <br />on how to 
    manage your career.</span>
    <form id="createuser_second" action="submit.php" method="post" style="font-size:12px; font-family:Calibri; margin-top:10px; margin-left:22px;">
        <input type="hidden" name="form_id" value="createuser_second" />			
        <div class="onerow">
            <div class="span2" style="font-size:12px;font-family:Calibri;">Email:</div>
            <div class="span6">
                <input type="text" name="email" id="email" class="input_text" />
            </div>
        </div>
        <div class="onerow">
            <div class="span2" style="font-size:12px;font-family:Calibri;">Confirm email:</div>
            <div class="span6">
                <input type="text" name="confirm_email" id="confirm_email" class="input_text" />
            </div>
        </div><br />					
        <div class="onerow">
            <div class="span2" style="font-size:12px;font-family:Calibri;">Password:</div>
            <div class="span6">
                <input type="password" name="password" id="password" class="input_text">
            </div>
        </div><br />
        <div class="onerow">
            <div class="span8" style="font-size:11px;font-family:Calibri;">
                <input type="checkbox" checked="checked" name="agree" id="agree" class="create_checkbox">
                Yes i would like to receive email alerts on careers that match my profile and free 
                information on managing my career.
            </div>
        </div>
        <div class="footer_go_back">
        <img src="<?=WEB_ROOT?>/Ajax/img/line.jpg" alt="" title="" />
            <span class="continue">
                <input type="submit" name="submit_bt" class="blue_button" value="Continue" />
            </span><!--submit-->
        </div>
    </form>
    </div>
</div>