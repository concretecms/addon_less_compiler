<?php defined('C5_EXECUTE') or die(_("Access Denied."));
$ui = Loader::helper('concrete/interface');
?>
<?=Loader::helper('concrete/dashboard')->getDashboardPaneHeaderWrapper(t('Currently Watched Less Files'), false, false, false, array(), $settings)?>
<div class="ccm-pane-body">
	<? if (!isset($warning)) { ?>
	<table class='ccm-results-list'>
		<thead>
			<tr><th><?=t('From')?>  <em><?=$frpath?></em></th><th><?=t('To')?> <em><?=$topath?></em></th></tr>
		</thead>
		<tbody>
			<?=(!isset($files[0])?'<tr><td colspan=2>'.t('Add LESS files to ').'<em>'.realpath(LESSDIR).'</em>, then run the job to compile.</td></tr>':'')?>
			<?php foreach($files as $file) echo "<tr><td>$file</td><td>".substr($file,0,strlen($file)-5).".css</td></tr>" ?>
		</tbody>
	</table>
	<? } else echo "<center class='label warning'>{$warning}</center>"; ?>
</div>
<div class="ccm-pane-footer">
	<?=$ui->button('Compile LESS',$compileurl,'right','primary')?>
</div>
<?=Loader::helper('concrete/dashboard')->getDashboardPaneFooterWrapper(false)?>