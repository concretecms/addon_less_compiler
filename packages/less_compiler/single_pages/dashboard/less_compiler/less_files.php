<?php defined('C5_EXECUTE') or die(_("Access Denied.")) ?>
<?php $form = Loader::helper('form') ?>
<?php $ih = Loader::helper('concrete/interface') ?>
<?php $valt = Loader::helper('validation/token') ?>
<?=Loader::helper('concrete/dashboard')->getDashboardPaneHeaderWrapper(t('Currently Watched Less Files'), false, false, false, array(), $settings)?>
<div class="ccm-pane-body">
	<table>
		<tbody>
			<?=(!isset($files[0])?'<tr><td>No LESS Files</td></tr>':'')?>
			<?php
			foreach($files as $file) {
				echo "<tr><td>$file</td></tr>";
			}
			?>
		</tbody>
	</table>
</div>
<div class="ccm-pane-footer"></div><!-- Adds rounded corners to the footer --> 
<?=Loader::helper('concrete/dashboard')->getDashboardPaneFooterWrapper(false)?>