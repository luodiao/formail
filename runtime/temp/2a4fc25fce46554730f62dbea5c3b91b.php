<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:78:"/Users/luodiao/Sites/admin/public/../application/index/view/user/register.html";i:1555662058;}*/ ?>
<div id="content-container" class="container">
    <div class="user-section login-section">
        <div class="logon-tab clearfix"> <a href="<?php echo url('user/login'); ?>"><?php echo __('Sign in'); ?></a> <a class="active"><?php echo __('Sign up'); ?></a> </div>
        <div class="login-main"> 
            <form name="form1" id="register-form" class="form-vertical" method="POST" action="">
                <input type="hidden" name="invite_user_id" value="0" />
                <input type="hidden" name="url" value="<?php echo $url; ?>" />
                <?php echo token(); ?>
                <div class="form-group">
                    <label class="control-label required"><?php echo __('Email'); ?><span class="text-success"></span></label>
                    <div class="controls">
                        <input type="text" name="email" id="email" data-rule="required;email" class="form-control input-lg" placeholder="<?php echo __('Email'); ?>">
                        <p class="help-block"></p>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label"><?php echo __('Username'); ?></label>
                    <div class="controls">
                        <input type="text" id="username" name="username" data-rule="required;username" class="form-control input-lg" placeholder="<?php echo __('Username must be 3 to 30 characters'); ?>">
                        <p class="help-block"></p>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label"><?php echo __('Password'); ?></label>
                    <div class="controls">
                        <input type="password" id="password" name="password" data-rule="required;password" class="form-control input-lg" placeholder="<?php echo __('Password must be 6 to 30 characters'); ?>">
                        <p class="help-block"></p>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label"><?php echo __('Mobile'); ?></label>
                    <div class="controls">
                        <input type="text" id="mobile" name="mobile" data-rule="required;mobile" class="form-control input-lg" placeholder="<?php echo __('Mobile'); ?>">
                        <p class="help-block"></p>
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label"><?php echo __('Captcha'); ?></label>
                    <div class="controls">
                        <div class="input-group input-group-lg">
                            <input type="text" name="captcha" class="form-control" placeholder="<?php echo __('Captcha'); ?>" data-rule="required;length(4)" style="border-radius: 0;" />
                            <span class="input-group-addon" style="padding:0;border:none;">
                                <img src="<?php echo captcha_src(); ?>" width="140" height="42" onclick="this.src = '<?php echo captcha_src(); ?>?r=' + Math.random();"/>
                            </span>
                        </div>
                        <p class="help-block"></p>
                    </div>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block"><?php echo __('Sign up'); ?></button>
                </div>
            </form>
        </div>
    </div>
</div>