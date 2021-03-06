<?php
  /**
   * Upcoming Events
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2016
   * @version $Id: index.tpl.php, v1.00 2016-12-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
  
  Bootstrap::Autoloader(array(APLUGPATH . 'upevent/'));
?>
<!-- Upcoming Events -->
<?php if($conf = Utility::findInArray($data['all'], "id", $data['id'])):?>
<div class="wojo plugin segment<?php echo ($conf[0]->alt_class) ? ' ' . $conf[0]->alt_class : null;?>">
  <?php if($conf[0]->show_title):?>
  <h5><?php echo $conf[0]->title;?></h5>
  <?php endif;?>
  <?php if($conf[0]->body):?>
  <?php echo Url::out_url($conf[0]->body);?>
  <?php endif;?>
  <?php if($data = App::UpEvent()->Render()):?>
  <div class="wojo very relaxed divided list">
    <?php foreach($data as $row):?>
    <div class="item">
      <div class="content">
        <div class="wojo label" style="background-color:<?php echo $row->color;?>;border-color:<?php echo $row->color;?>">
          <?php echo Date::doDate("MMM", $row->date_start);?>
          <?php echo Date::doDate("YYYY", $row->date_start);?>
        </div>
        <h6 class="half-top-margin"><?php echo $row->title;?></h6>
        <i class="icon map marker"></i>
        <?php echo $row->venue;?> @<?php echo Date::doTime($row->time_start);?>
        <p class="wojo small text">
          <?php echo Validator::sanitize($row->body, "default", 70);?>
        </p>
      </div>
    </div>
    <?php endforeach;?>
  </div>
  <?php unset($row);?>
  <?php endif;?>
</div>
<?php if($conf[0]->jscode):?>
<script><?php echo $conf[0]->jscode;?></script>
<?php endif;?>
<?php endif;?>