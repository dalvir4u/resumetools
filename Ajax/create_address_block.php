<div style="width:600px; overflow:hidden;">
    <form id="createcontact_form" action="submit.php" method="post">
    <input type="hidden" name="form_id" value="createcontact_detail" />
    <input type="hidden" name="rid" value="<?=$_GET['id']?>" />
        <div class="onerow">
            <div class="span10">
                <div class="input_title">Address line 1</div>
                <div>
                <input type="text" name="street" id="street" class="input_text" />
                </div>
            </div>
        </div>
        <div class="onerow">
            <div class="span10">
                <div class="input_title">Address line 2</div>
                <div>
                <input type="text" name="street2" id="street2" class="input_text" />
                </div>
            </div>
        </div>
        <div class="onerow">
            <div class="span4">
                <div class="input_title">City</div>
                <div>
                    <input type="text" name="city" id="city" class="input_text" />
                </div>
            </div>
            <div class="span3">
                <div class="input_title">State/Province</div>
                <div>
                    <!--<input type="text" name="state" id="state" class="input_text" />-->
                    <select name="state">
                    <?php 
                    $state_list = $co->load_all_states();
                    foreach($state_list as $state_name){
                        echo '<option value="'.$state_name['sname'].'">'.$state_name['sname'].'</option>';	
                    }
                    ?>
                    </select>
                </div>
            </div>
            <div class="span2">
                <div class="input_title">Zip</div>
                <div>
                    <input type="text" name="zip" id="mask_zip" class="input_text" />
                </div>
            </div>
        </div>
        <div class="onerow">
            <div class="span5">
                <div class="input_title">Home Phone Number</div>
                <div>
                    <input type="text" name="phone_num" id="mask_phone" class="input_text" />
                </div>
            </div>                
        </div>
        <div class="onerow">
            <div class="span7">
                <div class="input_title">Email</div>
                <div>
                    <input type="text" name="email" class="input_text" />
                </div>
            </div>
        </div>
        <div class="onerow">
            <div class="span10">
                <div style="font-size:12px;">
                    <input type="checkbox" name="disclaimer" value="1" />
                    <a href="index.php?page_id=8">
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry.</a>
                </div>
            </div>
        </div>
        <div class="footer_go_back">
            <img src="<?=WEB_ROOT?>/Ajax/img/line.jpg" alt="" title="" />               
            <span class="continue">
                <input type="submit" value="Save changes" class="blue_button" />
            </span>
        </div>
    </form>
</div>