<?php defined('C5_EXECUTE') or die(_("Access Denied."));
$ui = Loader::helper('concrete/interface');
?>
<?=Loader::helper('concrete/dashboard')->getDashboardPaneHeaderWrapper(t('Currently Watched Less Files'), false, false, false, array(), $settings)?>
<div class="ccm-pane-body">
	<?php if (!isset($warning)) { ?>
	<table>
		<thead>
			<tr><th><?=t('From')?>  <em><?=$frpath?></em></th><th><?=t('To')?> <em><?=$topath?></em></th></tr>
		</thead>
		<tbody>
			<?=(!isset($files[0])?'<tr><td colspan=2>'.t('Add LESS files to ').'<em>'.realpath(LESS_LESSDIR).'</em>, '.t('then run the job to compile').'.</td></tr>':'')?>
			<?php foreach($files as $file) echo "<tr><td>$file</td><td>".substr($file,0,strlen($file)-5).".css</td></tr>" ?>
		</tbody>
	</table>
	<?php } else echo "<center class='label warning'>{$warning}</center>"; ?>
</div>
<div class="ccm-pane-footer">
	<?=$ui->button(t('Compile LESS'),$compileurl,'right','primary')?>
</div>
<?=Loader::helper('concrete/dashboard')->getDashboardPaneFooterWrapper(false)?>