<?php
/**
 * Theme 11 customisation drawer (Admin > Options > Preview).
 * Everything the user can change is a --t11-* variable, see app/controllers/components/pjTheme11.component.php
 * $t11 = pjTheme11::adminData()
 */
$t11 = isset($tpl['t11']) ? $tpl['t11'] : array();
if (empty($t11))
{
	return;
}
// label with a fallback so the panel also works before the labels are imported
$L = function ($key, $fallback) {
	$v = __($key, true);
	return ($v === NULL || $v === '') ? $fallback : $v;
};
$groups = array(
	array('t11_group_surfaces', 'Surfaces', array('page' => 'Page background', 'card' => 'Cards', 'soft' => 'Soft areas / chips', 'line' => 'Borders', 'accent' => 'Accent')),
	array('t11_group_text', 'Text', array('heading' => 'Headings', 'body' => 'Body text', 'muted' => 'Muted text', 'link' => 'Links', 'price' => 'Prices')),
	array('t11_group_buttons', 'Buttons', array('btn' => 'Primary button', 'btn_text' => 'Primary button text', 'btn_hover' => 'Primary button hover', 'btn2' => 'Secondary button', 'btn2_text' => 'Secondary button text')),
	array('t11_group_slots', 'Time slots', array('slot_free' => 'Available', 'slot_sel' => 'Selected', 'slot_sel_text' => 'Selected text', 'slot_busy' => 'Booked'))
);
$radius_labels = array('sharp' => array('t11_radius_sharp', 'Sharp'), 'soft' => array('t11_radius_soft', 'Soft'), 'round' => array('t11_radius_round', 'Round'));
$shadow_labels = array('none' => array('t11_shadow_none', 'None'), 'soft' => array('t11_shadow_soft', 'Soft'), 'lifted' => array('t11_shadow_lifted', 'Lifted'));
$vals = $t11['values'];
?>
<div id="t11Panel" class="t11-panel" aria-hidden="true" data-url="<?php echo pjSanitize::html($_SERVER['PHP_SELF']); ?>?controller=pjAdminOptions&amp;action=pjActionSaveTheme11"
	data-config="<?php echo pjSanitize::html(json_encode(array(
		'defaults' => $t11['defaults'],
		'palettes' => $t11['palettes'],
		'fonts' => $t11['fonts'],
		'radii' => $t11['radii'],
		'shadows' => $t11['shadows'],
		'colors' => $t11['colors'],
		'values' => $vals
	))); ?>">
	<div class="t11-panel-head">
		<strong><i class="fa fa-paint-brush m-r-xs"></i> <?php echo pjSanitize::html($L('t11_panel_title', 'Theme 11 design')); ?></strong>
		<button type="button" class="t11-close" data-t11="close" aria-label="<?php echo pjSanitize::html($L('t11_close', 'Close')); ?>">&times;</button>
	</div>

	<div class="t11-panel-body">
		<p class="t11-hint"><?php echo pjSanitize::html($L('t11_panel_hint', 'Changes appear in the preview straight away. Press Save to publish them to your website.')); ?></p>

		<div class="t11-section">
			<h4><?php echo pjSanitize::html($L('t11_palettes', 'Colour palettes')); ?></h4>
			<div class="t11-palettes">
				<?php foreach ($t11['palettes'] as $key => $palette) : $name = $L('t11_palette_' . $key, $palette['name']); ?>
					<button type="button" class="t11-palette" data-palette="<?php echo pjSanitize::html($key); ?>" title="<?php echo pjSanitize::html($name); ?>">
						<span class="t11-palette-sw">
							<i style="background:<?php echo pjSanitize::html($palette['colors']['page']); ?>"></i><i style="background:<?php echo pjSanitize::html($palette['colors']['accent']); ?>"></i><i style="background:<?php echo pjSanitize::html($palette['colors']['btn']); ?>"></i><i style="background:<?php echo pjSanitize::html($palette['colors']['heading']); ?>"></i>
						</span>
						<span class="t11-palette-name"><?php echo pjSanitize::html($name); ?></span>
					</button>
				<?php endforeach; ?>
			</div>
		</div>

		<?php foreach ($groups as $group) : ?>
			<div class="t11-section">
				<h4><?php echo pjSanitize::html($L($group[0], $group[1])); ?></h4>
				<?php foreach ($group[2] as $token => $fallback) : ?>
					<div class="t11-row">
						<label for="t11_hex_<?php echo $token; ?>"><?php echo pjSanitize::html($L('t11_c_' . $token, $fallback)); ?></label>
						<span class="t11-color">
							<input type="color" class="t11-picker" data-token="<?php echo $token; ?>" value="<?php echo pjSanitize::html($vals[$token]); ?>">
							<input type="text" id="t11_hex_<?php echo $token; ?>" class="t11-hex" data-token="<?php echo $token; ?>" value="<?php echo pjSanitize::html($vals[$token]); ?>" maxlength="7" spellcheck="false" autocomplete="off">
						</span>
					</div>
				<?php endforeach; ?>
			</div>
		<?php endforeach; ?>

		<div class="t11-section">
			<h4><?php echo pjSanitize::html($L('t11_group_type', 'Typography')); ?></h4>
			<div class="t11-row">
				<label for="t11_font_head"><?php echo pjSanitize::html($L('t11_font_head', 'Heading font')); ?></label>
				<select id="t11_font_head" class="t11-field" data-token="font_head">
					<?php foreach ($t11['fonts'] as $k => $f) : ?>
						<option value="<?php echo pjSanitize::html($k); ?>"<?php echo $vals['font_head'] === $k ? ' selected="selected"' : ''; ?>><?php echo pjSanitize::html($f['name']); ?></option>
					<?php endforeach; ?>
				</select>
			</div>
			<div class="t11-row">
				<label for="t11_font_body"><?php echo pjSanitize::html($L('t11_font_body', 'Body font')); ?></label>
				<select id="t11_font_body" class="t11-field" data-token="font_body">
					<?php foreach ($t11['fonts'] as $k => $f) : ?>
						<option value="<?php echo pjSanitize::html($k); ?>"<?php echo $vals['font_body'] === $k ? ' selected="selected"' : ''; ?>><?php echo pjSanitize::html($f['name']); ?></option>
					<?php endforeach; ?>
				</select>
			</div>
			<div class="t11-row">
				<label for="t11_font_size"><?php echo pjSanitize::html($L('t11_font_size', 'Text size')); ?></label>
				<select id="t11_font_size" class="t11-field" data-token="font_size">
					<?php for ($n = 13; $n <= 17; $n++) : ?>
						<option value="<?php echo $n; ?>"<?php echo (int) $vals['font_size'] === $n ? ' selected="selected"' : ''; ?>><?php echo $n; ?> px</option>
					<?php endfor; ?>
				</select>
			</div>
			<p class="t11-note"><?php echo pjSanitize::html($L('t11_font_note', 'Web fonts are loaded from Google Fonts. Choose "System UI" to avoid any external request.')); ?></p>
		</div>

		<div class="t11-section">
			<h4><?php echo pjSanitize::html($L('t11_group_shape', 'Shape & layout')); ?></h4>
			<div class="t11-row">
				<label><?php echo pjSanitize::html($L('t11_radius', 'Corners')); ?></label>
				<span class="t11-seg" data-token="radius">
					<?php foreach ($radius_labels as $k => $l) : ?>
						<button type="button" data-value="<?php echo $k; ?>" class="<?php echo $vals['radius'] === $k ? 'active' : ''; ?>"><?php echo pjSanitize::html($L($l[0], $l[1])); ?></button>
					<?php endforeach; ?>
				</span>
			</div>
			<div class="t11-row">
				<label><?php echo pjSanitize::html($L('t11_shadow', 'Shadows')); ?></label>
				<span class="t11-seg" data-token="shadow">
					<?php foreach ($shadow_labels as $k => $l) : ?>
						<button type="button" data-value="<?php echo $k; ?>" class="<?php echo $vals['shadow'] === $k ? 'active' : ''; ?>"><?php echo pjSanitize::html($L($l[0], $l[1])); ?></button>
					<?php endforeach; ?>
				</span>
			</div>
			<div class="t11-row">
				<label for="t11_steps"><?php echo pjSanitize::html($L('t11_steps', 'Show the step tracker')); ?></label>
				<input type="checkbox" id="t11_steps" class="t11-check" data-token="steps"<?php echo $vals['steps'] === '1' ? ' checked="checked"' : ''; ?>>
			</div>
		</div>
	</div>

	<div class="t11-panel-foot">
		<span class="t11-status" role="status"></span>
		<button type="button" class="btn btn-secondary" data-t11="reset"><?php echo pjSanitize::html($L('t11_reset', 'Reset to default')); ?></button>
		<button type="button" class="btn btn-primary" data-t11="save"><i class="fa fa-check m-r-xs"></i> <?php echo pjSanitize::html($L('t11_save', 'Save')); ?></button>
	</div>
</div>
<div class="hidden" id="t11Msgs"
	data-saved="<?php echo pjSanitize::html($L('t11_msg_saved', 'Saved. Your website now uses these settings.')); ?>"
	data-reset="<?php echo pjSanitize::html($L('t11_msg_reset', 'Default design restored.')); ?>"
	data-error="<?php echo pjSanitize::html($L('t11_msg_error', 'Could not save. Please try again.')); ?>"
	data-confirm="<?php echo pjSanitize::html($L('t11_msg_confirm', 'Restore the default design? Your saved colours and fonts will be replaced.')); ?>"></div>
