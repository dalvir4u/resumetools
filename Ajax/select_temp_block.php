<div style="width:600px; overflow:hidden;">
    <div style="width:546px; margin:auto; text-align:left">
    <img src="<?=WEB_ROOT?>/img/second_step.jpg" alt="" title="" />
    <div style="font-size:12px; margin-bottom:20px; text-align:left;">
    Tell us a little bit more about your experience and we will match you to the right resume template.
    You can change template at anytime.
    </div>
    <form id="createuser_first" style="text-align:left; font-size:14px; line-height:20px; font-family:Calibri">
    <input type="hidden" name="form_id" value="createuser_first" />
        <div style="width:546px; overflow:hidden; margin-top:5px;">
        
        <div class="onerow">
            <div class="span2" style="font-size:14px;font-family:Calibri;">Experience Level:</div>
            <div class="span6">
                <select name="experience" class="input_text">
                    <option value="Student">Student</option>
                    <option value="Entry Level">Entry Level</option>
                    <option value="Experienced">Experienced</option>
                    <option value="Manager">Manager</option>
                    <option value="Executive">Executive</option>
                </select>
            </div>
        </div>
        <div class="onerow">
            <div class="span2" style="font-size:14px;font-family:Calibri;">Career Field:</div>
            <div class="span6">
                <select name="career" class="input_text">
                    <option value="">Select One</option>
                    <?php
                    $careers = $co->fetch_all_array("select * from career");
                    foreach($careers as $career){
                        echo '<option value="'.$career['career_id'].'">'.$career['career_name'].'</option>';
                    }
                    ?>
                </select>
            </div>
        </div>
        <div class="onerow">
            <div class="span2" style="font-size:14px;font-family:Calibri;">Education Level:</div>
            <div class="span6">
                <select name="education" class="input_text">
                    <option value="">Select One</option>
                    <option value="No high school">No High School Diploma or GED</option>
                    <option value="High school">High School Diploma</option>
                    <option value="GED">GED</option>
                    <option value="Some college">Some College</option>
                    <option value="Associate's Degree">Associate's Degree</option>
                    <option value="Bachelor's Degree">Bachelor's Degree</option>
                    <option value="Master's Degree">Master's Degree</option>
                    <option value="Ph. D.">Ph.D.</option>
                </select>
            </div>
        </div>
        <div class="onerow">
            <div class="span8" style="font-size:14px;font-family:Calibri;">Additional Information(check all that apply):</div>
            <div class="span8">
                <table>
                    <tr>
                    <td>                	
                        <input type="checkbox" name="add_info[]" value="live outside of US" />
                         Live Outside of US
                    </td>
                    <td>
                        <input type="checkbox" name="add_info[]" value="active military affiliation" />
                         Active Military Affiliation
                    </td>
                    </tr>
                    <tr>
                    <td>
                        <input type="checkbox" name="add_info[]" value="non-US citizen" />
                         Non-US Citizen
                    </td>
                    <td>    
                        <input type="checkbox" name="add_info[]" value="past military affiliation" />
                         Past Military Affiliation
                    </td>
                    </tr>
                    <tr>
                    <td>
                        <input type="checkbox" name="add_info[]" value="require US work visa" />
                         Require US Work Visa
                    </td>
                    <td>
                        <input type="checkbox" name="add_info[]" value="currently unemployed" />
                         Currently Unemployed
                    </td>
                    </tr>
                </table>
            </div>
        </div>
        
        </div>
        <div style="font-size:10px; margin-top:20px; text-align:center; color:#000; font-family:Verdana, Geneva, sans-serif">
        (if needed, you can change your template later)
        </div>
        <div class="footer_go_back">
        <img src="<?=WEB_ROOT?>/Ajax/img/line.jpg" alt="" title="" />
            <span class="continue">
            <input type="button" onClick="second_submit()" class="blue_button" value="Continue" /></span>
        </div>
    </form>
    </div>
</div>