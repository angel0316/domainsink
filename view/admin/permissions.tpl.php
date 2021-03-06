<?php
  /**
   * Permissions
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2018
   * @version $Id: permissions.tpl.php, v1.00 2018-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
	  
  if (!Auth::checkAcl("owner")) : print Message::msgError(Lang::$word->NOACCESS); return; endif;
?>
<?php switch(Url::segment($this->segments)): case "privileges": ?>
<!-- Start privileges -->
<h3><?php echo Lang::$word->M_TITLE2;?></h3>
<p><?php echo str_replace("[ROLE]", '<span class="wojo bold text">' . $this->role->name . '</span>', Lang::$word->M_SUB4);?> <?php echo ($this->role->code != "owner") ? '<span class="wojo bold text"><i>' . Lang::$word->M_INFO . '</i></span>' : null;?></p>
<div class="wojo segment">
  <table class="wojo six column basic sorting celled table" id="pTable">
    <thead>
      <tr>
        <th class="disabled"><?php echo Lang::$word->TYPE;?></th>
        <th class="disabled"><?php echo Lang::$word->ADD;?></th>
        <th class="disabled"><?php echo Lang::$word->EDIT;?></th>
        <th class="disabled"><?php echo Lang::$word->APPROVE;?></th>
        <th class="disabled"><?php echo Lang::$word->MANAGE;?></th>
        <th class="disabled"><?php echo Lang::$word->DELETE;?></th>
      </tr>
    </thead>
    <tbody>
      <?php
    foreach ($this->result as $type => $rows):
        echo '<tr>';
        echo '<td>' . $type . '</td>';
        echo '<td>';
        foreach ($rows as $i => $row):
            if (isset($row->mode) and $row->mode == "add") {
                $checked = ($row->active == 1) ? ' checked="checked"' : null;
                $is_owner = ($this->role->code == "owner") ? ' disabled="disabled"' : null;
                echo '<div class="wojo fitted checkbox" data-id="' . $row->id . '"><input id="perm_' . $row->id . '" type="checkbox" data-val="' . $row->active . '" value="' . $row->id . '" name="view-' . $row->id . '" ' . $is_owner . $checked . '><label for="perm_' . $row->id . '"></label><span data-tooltip="' . $row->description . '"><i class="icon question sign"></i></span></div> ';
            }
        endforeach;
        echo '</td>';
		
        echo '<td>';
        foreach ($rows as $row):
            if (isset($row->mode) and $row->mode == "edit") {
                $checked = ($row->active == 1) ? ' checked="checked"' : null;
                $is_owner = ($this->role->code == "owner") ? ' disabled="disabled"' : null;
                echo '<div class="wojo fitted checkbox" data-id="' . $row->id . '"><input id="perm_' . $row->id . '" type="checkbox" data-val="' . $row->active . '" value="' . $row->id . '" name="view-' . $row->id . '" ' . $is_owner . $checked . '><label for="perm_' . $row->id . '"></label><span data-tooltip="' . $row->description . '"><i class="icon question sign"></i></span></div>';
            }
        endforeach;
        echo '</td>';
  
        echo '<td>';
        foreach ($rows as $row):
            if (isset($row->mode) and $row->mode == "approve") {
                $checked = ($row->active == 1) ? ' checked="checked"' : null;
                $is_owner = ($this->role->code == "owner") ? ' disabled="disabled"' : null;
                echo '<div class="wojo fitted checkbox" data-id="' . $row->id . '"><input id="perm_' . $row->id . '" type="checkbox" data-val="' . $row->active . '" value="' . $row->id . '" name="view-' . $row->id . '" ' . $is_owner . $checked . '><label for="perm_' . $row->id . '"></label><span data-tooltip="' . $row->description . '"><i class="icon question sign"></i></span></div>';
            }
        endforeach;
        echo '</td>';

        echo '<td>';
        foreach ($rows as $row):
            if (isset($row->mode) and $row->mode == "manage") {
                $checked = ($row->active == 1) ? ' checked="checked"' : null;
                $is_owner = ($this->role->code == "owner") ? ' disabled="disabled"' : null;
                echo '<div class="wojo fitted checkbox" data-id="' . $row->id . '"><input id="perm_' . $row->id . '" type="checkbox" data-val="' . $row->active . '" value="' . $row->id . '" name="view-' . $row->id . '" ' . $is_owner . $checked . '><label for="perm_' . $row->id . '"></label><span data-tooltip="' . $row->description . '"><i class="icon question sign"></i></span></div>';
            }
        endforeach;
        echo '</td>';
		
        echo '<td>';
        foreach ($rows as $row):
            if (isset($row->mode) and $row->mode == "delete") {
                $checked = ($row->active == 1) ? ' checked="checked"' : null;
                $is_owner = ($this->role->code == "owner") ? ' disabled="disabled"' : null;
                echo '<div class="wojo fitted checkbox" data-id="' . $row->id . '"><input id="perm_' . $row->id . '" type="checkbox" data-val="' . $row->active . '" value="' . $row->id . '" name="view-' . $row->id . '" ' . $is_owner . $checked . '><label for="perm_' . $row->id . '"></label><span data-tooltip="' . $row->description . '"><i class="icon question sign"></i></span></div>';
            }
        endforeach;
        echo '</td>';
  
        echo '</tr>';
    endforeach;
  ?>
    </tbody>
  </table>
</div>
<div class="content-center"> <a href="<?php echo Url::url("/admin/permissions");?>" class="wojo simple small button"><?php echo Lang::$word->CANCEL;?></a> </div>
<script type="text/javascript"> 
// <![CDATA[  
$(document).ready(function () {
    $("#pTable").on('change', '.wojo.checkbox input', function() {
        var status = $(this).prop('checked') ? 1 : 0;
        var id = $(this).parent().data('id');
        $.post("<?php echo ADMINVIEW . "/helper.php";?>", {quickStatus:1,status:"role", id:id, active:status});
   });
});
// ]]>
</script>
<?php break;?>
<?php default: ?>
<h3><?php echo Lang::$word->M_TITLE1;?></h3>
<p class="wojo small text"><?php echo Lang::$word->M_SUB3;?></p>
<div class="row screen-block-3 tablet-block-2 mobile-block-1 phone-block-1 gutters align-center">
  <?php foreach ($this->data as $row):?>
  <div class="column">
    <div class="wojo segment content-center"> <img src="<?php echo ADMINVIEW;?>/images/<?php echo $row->code;?>.svg" alt="">
      <h4><?php echo $row->name;?></h4>
      <p id="item_<?php echo $row->id;?>" class="wojo tiny text content-center"><?php echo Validator::truncate($row->description, 100);?></p>
      <div class="wojo divider"></div>
      <div class="content-center"> <a href="<?php echo Url::url(Router::$path, "privileges/" . $row->id);?>" class="wojo icon negative small button"><i class="icon lock"></i></a> <a data-set='{"option":[{"doAction": 1, "processItem": 1,"page":"editRole", "editRole": 1,"id": <?php echo $row->id;?>}], "label":"<?php echo Lang::$word->M_INF01;?>", "url":"helper.php", "parent":"#item_<?php echo $row->id;?>", "action":"replace", "modalclass":"small"}' class="wojo icon small positive button addAction"> <i class="icon pencil"></i></a> </div>
    </div>
  </div>
  <?php endforeach;?>
</div>
<?php break;?>
<?php endswitch;?>