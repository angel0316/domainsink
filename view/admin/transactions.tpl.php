<?php
  /**
   * Transactions
   *
   * @package Wojo Framework
   * @author wojoscripts.com
   * @copyright 2018
   * @version $Id: transactions.tpl.php, v1.00 2018-05-05 10:12:05 gewa Exp $
   */
  if (!defined("_WOJO"))
      die('Direct access to this location is not allowed.');
	  
  if (!Auth::checkAcl("owner")) : print Message::msgError(Lang::$word->NOACCESS); return; endif;
?>
<h3 class="header"><?php echo Lang::$word->TRX_PAY;?></h3>
<div class="wojo card" id="pData">
  <div class="header">
    <div class="row horizontal-gutters align-middle">
      <div class="column">
        <a data-dropdown="#dropdown-timeRange" class="wojo white icon circular button" id="timeRange">
          <i class="icon horizontal ellipsis"></i>
        </a>
        <div class="wojo small dropdown pointing menu top-left" id="dropdown-timeRange">
          <a class="item" data-value="all"><?php echo Lang::$word->ALL;?></a>
          <a class="item" data-value="day"><?php echo Lang::$word->TODAY;?></a>
          <a class="item" data-value="week"><?php echo Lang::$word->THIS_WEEK;?></a>
          <a class="item" data-value="month"><?php echo Lang::$word->THIS_MONTH;?></a>
          <a class="item" data-value="year"><?php echo Lang::$word->THIS_YEAR;?></a>
        </div>
      </div>
      <div class="column shrink">
      <div id="legend" class="wojo small horizontal inverted flex list align-middle"> </div>
      </div>
    </div>
  </div>
  <div class="content" id="payment_chart" style="height:400px"></div>
</div>
<?php if($this->data):?>
<div class="wojo segment">
  <form method="get" id="wojo_form" action="<?php echo Url::url(Router::$path);?>" name="wojo_form">
    <div class="row align-middle half-vertical-gutters">
      <div class="column screen-30 tablet-40 mobile-100 phone-100">
        <div class="wojo fluid small right icon input" id="fromdate">
          <input name="fromdate" type="text" placeholder="<?php echo Lang::$word->FROM;?>" readonly>
          <i class="icon calendar"></i>
        </div>
      </div>
      <div class="column screen-30 tablet-40 mobile-100 phone-100">
        <div class="wojo fluid small left right icon input" id="enddate">
          <i class="calendar icon"></i>
          <input name="enddate" type="text" placeholder="<?php echo Lang::$word->TO;?>" readonly>
          <button id="doDates" class="wojo small basic icon button"><i class="icon find"></i></button>
        </div>
      </div>
      <div class="column shrink phone-hide mobile-hide">
        <div class="wojo separator"></div>
      </div>
      <div class="column shrink phone-hide">
        <a href="<?php echo Url::url(Router::$path);?>" class="wojo small basic icon button"><i class="icon refresh"></i></a>
      </div>
      <div class="column content-right phone-content-center phone-100">
        <a href="<?php echo ADMINVIEW;?>/helper.php?exportAllTransactions=1<?php echo Url::query();?>" class="wojo small primary icon button"><i class="icon wysiwyg table"></i></a>
      </div>
    </div>
  </form>
  <div class="wojo divider phone-hide mobile-hide"></div>
  <table class="wojo sorting basic table">
    <thead>
      <tr>
        <th class="disabled center aligned"><i class="icon disabled id"></i></th>
        <th data-sort="string"><?php echo Lang::$word->ITEM;?></th>
        <th data-sort="string"><?php echo Lang::$word->USER;?></th>
        <th data-sort="int"><?php echo Lang::$word->TRX_PP;?></th>
        <th data-sort="int"><?php echo Lang::$word->TRX_TOTAMT;?></th>
        <th data-sort="int"><?php echo Lang::$word->CREATED;?></th>
      </tr>
    </thead>
    <?php foreach ($this->data as $row):?>
    <tr id="item_<?php echo $row->id;?>">
      <td class="collapsing"><span class="wojo small basic label"><?php echo $row->id;?></span></td>
      <td><?php echo $row->title;?></td>
      <td><?php echo $row->name;?></td>
      <td><?php echo $row->pp;?></td>
      <td><?php echo $row->total;?></td>
      <td data-sort-value="<?php echo strtotime($row->created);?>"><?php echo Date::doDate("short_date", $row->created);?></td>
    </tr>
    <?php endforeach;?>
  </table>
  <div class="wojo double divider"></div>
  <div class="wojo small passive button"><?php echo Lang::$word->TRX_TOTAMT;?>
    <?php echo Utility::formatMoney(Stats::doArraySum($this->data, "total"));?></div>
</div>
<div class="row half-gutters-mobile half-gutters-phone align-middle">
  <div class="columns shrink mobile-100 phone-100">
    <div class="wojo small thick text"><?php echo Lang::$word->TOTAL.': '.$this->pager->items_total;?> / <?php echo Lang::$word->CURPAGE.': '.$this->pager->current_page.' '.Lang::$word->OF.' '.$this->pager->num_pages;?></div>
  </div>
  <div class="columns mobile-100 phone-100 content-right mobile-content-left"><?php echo $this->pager->display_pages('small');?></div>
</div>
<?php endif;?>
<script type="text/javascript" src="<?php echo SITEURL;?>/assets/morris.min.js"></script>
<script type="text/javascript" src="<?php echo SITEURL;?>/assets/raphael.min.js"></script>
<script type="text/javascript"> 
// <![CDATA[
$(document).ready(function() {	
    function getStats(range) {
        $("#pData").addClass('loading');
		$("#payment_chart").empty();
        $.ajax({
            type: 'GET',
            url: "<?php echo ADMINVIEW;?>/helper.php?getSalesChart=1&timerange=" + range,
            dataType: 'json'
        }).done(function(json) {
			var legend = '';
            json.legend.map(function(val) {
               legend += val;
            });
			$("#legend").html(legend);
            Morris.Line({
                element: 'payment_chart',
                data: json.data,
                xkey: 'm',
                ykeys: json.label,
                labels: json.label,
                parseTime: false,
                lineWidth: 4,
                pointSize: 6,
                lineColors: json.color,
				gridTextFamily: "Roboto",
				gridTextColor: "rgba(0,0,0,0.6)",
				gridTextSize: 14,
                fillOpacity: '.1',
                hideHover: 'auto',
				preUnits: json.preUnits,
				hoverCallback: function(index, json, content) {
					var text = $(content)[1].textContent;
					return content.replace(text, text.replace(json.preUnits, ""));
				},
                smooth: true,
                resize: true,
            });
            $("#pData").removeClass('loading');
        });
    }
    getStats('all');
	
    $("#dropdown-timeRange").on('click', '.item', function() {
		$("#payment_chart").html('');
        getStats($(this).data('value'));
    });
});
// ]]>
</script>