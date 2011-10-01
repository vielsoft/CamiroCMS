<h2 class="title">Welcome to CamiroCMS Administration Page</h2>
<!-- this is a temporary layout for admin -->
<?php echo $this->element('modules/admin_mod_latestContents', array('cache' => 'true'));?>
<?php echo $this->element('modules/admin_mod_latestContentContainer', array('cache' => 'true')); ?>
<?php echo $this->element('modules/admin_mod_latestMenus', array('cache' => 'true'));?>
<?php // echo $this->element('modules/admin_mod_latestUsers', array('cache' => 'true'));?>