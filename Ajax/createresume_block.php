<div style="width:600px; text-align:center; overflow:hidden;">
    <div style="width:546px; margin:auto">
    <img src="<?=WEB_ROOT?>/img/first_step.jpg" alt="" title="" /><br />
    <div style="font-size:12px; margin-bottom:20px; text-align:left;">JobShepherd is here to help you create and maintain a winning resume. With 1000's of templates to choose from, you will be able to customize a resume that fits your needs while using industry best practices. Get started today !
    </div>
    <form id="createresumefirst" style="text-align:right; font-size:12px; line-height:26px;">
        <input type="hidden" name="form_id" value="createresume_first" />			
        <div class="onerow">
            <div class="span2" style="font-size:14px;font-family:Calibri;">First Name:</div>
            <div class="span6">
                <input type="text" name="fname" id="fname" class="input_text" />
                <div id="fname_error" style="display:none">This field is required</div>
            </div>
        </div>
        <div class="onerow">
            <div class="span2" style="font-size:14px;font-family:Calibri;">Last Name:</div>
            <div class="span6">
                <input type="text" name="lname" id="lname" class="input_text" />
                <div id="lname_error" style="display:none">This field is required</div>
            </div>
        </div>
        <div style="text-align:left; padding-left:10px; margin: 20px;">
        Already have a resume created? 
        <a href="login.php">Login here</a>
        </div>
        <div class="footer_go_back">
        <img src="<?=WEB_ROOT?>/Ajax/img/line.jpg" alt="" title="" />
            <span class="continue">
            <input type="button" onClick="first_submit()" class="blue_button" value="Continue" /></span>
        </div>
    </form>
    </div>
</div>