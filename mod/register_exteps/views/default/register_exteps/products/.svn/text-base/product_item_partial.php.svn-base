<?php 

$user = $vars['entity'];
$products = $vars['products'];
$max_items = $vars['max_items'];
$products_ammount = $vars['products_ammount'];

if (!is_array($products)) {
	$products = array();
}

if (empty($max_items)) {
	$max_items = 0;
}

if (!$user) {
    $user = ProfileComplete::get_user_entity();
}

if (empty($products_ammount)) {
	$products_ammount = 0;
}

$callback = get_input('callback', FALSE);

$offset = get_input('offset', 0);
?>

<div id="append_products">
	<div class="rowProd">
		<?php
		$i_break = 0;
		$i = 0;

		foreach ($products as $product) {
			$value = NULL;
			if (check_entity_relationship($user->getGUID(), USER_BAR_PRODUCTS_REL, $product->getGUID())) {
				$value = $product->title;
			}
			?>
			<div class="item <?php if ($i_break == 4) {
			echo 'nmRig';
		} ?>">
			<?php echo elgg_view('input/checkboxes', array('value' => $value, 'name' => "product[{$product->getGUID()}]", 'options' => array($product->title))) ?>
			</div>
			<?php
			if (($i_break == 4) || ($i == ($max_items - 1))) {
				$i_break = 0;
				echo '<div class="cThis">&nbsp;</div></div>';
				if ($i != ($max_items - 1)) {
					echo '<div class="rowProd">';
				}
			} else {
				$i_break++;
			}
			$i = $i + 1;
		}
		?>

		<?php if ($offset < ($products_ammount - $max_items)) {?>
			<div class="ajaxProducts flRig">
				<a href="javascript:retrieve_products_ajax(this)" id="retrieve_products_ajax" class="retrieveProducts">
					<?php echo elgg_echo('register_exteps:products:view_more')?>
				</a>
			</div>	
		<?php } ?>

	</div>
</div>