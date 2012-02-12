<?php defined('C5_EXECUTE') or die(_("Access Denied.")) ?>

<?=Loader::helper('concrete/dashboard')->getDashboardPaneHeaderWrapper(t('Currently Watched Less Files'), false, false, false, array(), $settings)?>
<div class="ccm-pane-body">
	<table>
		<thead>
			<tr><th>From <em><?=$frpath?></em></th><th>To <em><?=$topath?></em></th></tr>
		</thead>
		<tbody>
			<?=(!isset($files[0])?'<tr><td colspan=2>No LESS Files</td></tr>':'')?>
			<?php foreach($files as $file) echo "<tr><td>$file</td><td>".substr($file,0,strlen($file)-5).".css</td></tr>" ?>
		</tbody>
	</table>
</div>
<div class="ccm-pane-footer"></div><!-- Adds rounded corners to the footer --> 
<?=Loader::helper('concrete/dashboard')->getDashboardPaneFooterWrapper(false)?>