<?php

$doc_type = 0;
$doc_id = '';
if ($vars['value']) {

	if (isset($vars['value'])) {
		$tmp_val = $vars['value'];
		if (!empty($tmp_val)) {
			$tmp_val = explode('-', $tmp_val);
			if (count($tmp_val) == 2) {
				$doc_type = $tmp_val[0];
				$doc_id = $tmp_val[1];
			}
		}
	}
} else {
	if ($vars['entity'] instanceof ElggEntity) {
		$doc_type = $vars['entity']->tipo_documento;
		$doc_id = $vars['entity']->numero_documento;
	}
}

$doc_type_opt = array(
	'value' => $doc_type,
	'name' => 'tipo_documento',
	'class' => 'txtFrm33',
	'options_values' => kt_profile_get_dni_types(TRUE),
);

$doc_id_opt = array(
	'value' => $doc_id,
	'name' => 'numero_documento',
	'class' => 'txtFrm50',
);
?>

<div class="KtDocumentIdInput ">
	<?php echo elgg_view('input/pulldown', $doc_type_opt)?>
	<?php echo elgg_view('input/text', $doc_id_opt)?>
	<div class="cThis">&nbsp;</div>
</div>
