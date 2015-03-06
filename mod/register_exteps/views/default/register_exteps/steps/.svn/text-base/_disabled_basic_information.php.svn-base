<?php
/**
 * Basic Information tab
 */

//$terms_condition_label = "I have reviewed and accept the <a href='#terms'>Terms of use</a>";
//$drinking_condition_label = "I confirm that I am a legal dkinking age in my country of recidence.";
//
//
//$r_type = get_input('user_type');
//
//if ($r_type == 'bar') {
//	$action = 'admin_information';
//} else {
//	$action = 'personal_information';
//}
//
//$action_url = elgg_http_add_url_query_elements(current_page_url(), array('tab' => $action));
//$step = register_exteps_get_step();
//if ($step != 'basic_information') {
//	if ($step != 'go_home') {
//		register_exteps_gatekeeper();
//	} else {
//		forward();
//	}
//}

$form = new userSubtypesForm();
$fields = $form->renderFieldsToArray(array('ignore_marked_required' => TRUE));

$terms_conditions = array(
	'terms_condition',
	'drinking_condition'
);

?>
<?php echo $fields['_render_']['header'] ?>
	<div class="userSettingsWhite uswReg">
		<div class="regLefRig">
			<div class="ktFormWrapperGroup basicInformation">
				
				<?php foreach($fields as $field_name => $field) {?>
					<?php 
						if (in_array($field_name, $terms_conditions)) {
							continue;					
					}
					
					$extra_class = '';
					
					switch($field_name) {
						case 'password2':
							$extra_class = 'moreMargin';	
						break;
					
					case 'user_type':
						case 'friend_guid':
						case 'invite_code':
						$extra_class = 'no';	
					break;
					
					case 'email':
						$hide_email = get_input('invite_code_gatekeeper');
							if (!empty($hide_email)) {
								$extra_class = 'no';
								
							}
						break;
							
						default:
							$extra_class = ktform_camelize_string($extra_class);
						break;
					}
					?>
					<div class="ktFormWrapper <?php echo $extra_class ?>">
						<label for=""><?php echo $field['label'] ?></label>
						<div class="frmField">
							<?php echo $field['field'] ?>
							<div class="clearfloat">&nbsp;</div>
						</div>
						<div class="clearfloat">&nbsp;</div>
					</div>
				
				<?php } ?>
				
				<?php foreach($terms_conditions as $condition) {
					if (array_key_exists($condition, $fields) == FALSE) {
						continue;
					}
					
					?>
				<div class="ktFormWrapper <?php echo ktform_camelize_string($condition, FALSE) ?>">
					<div class="frmField flN">
						<label class="lblCustomCheck">
							<span class="spanCheck">
									<?php echo $fields[$condition]['field']?>
							</span>
							<span class="txtCustomCheck"><?php echo $fields[$condition]['label']?></span>
						</label>
						<div class="clearfloat">&nbsp;</div>
					</div>
					<div class="clearfloat">&nbsp;</div>
				</div>		
				<?php } ?>

			</div>
			<div class="innerTabInformation">
				<?php echo elgg_view('register_exteps/steps/tab_info/' . $vars['tab'], array_merge($vars, array('invitation' => $invitation))) ?>
			</div>
			<div class="cThis">&nbsp;</div>
		</div>
		<div class="ktForm rBtn">
			<span class="rBtnTxt"><?php echo elgg_echo('register_exteps:register:label:all_fields') ?></span>
			<input name="submit" type="submit" class="submit_button" rel="<?php echo elgg_echo('register_exteps:buttons:next') ?>" value="<?php echo elgg_echo('register_exteps:buttons:next') ?>">
			<div class="clearfloat">&nbsp;</div>
		</div>
	</div>
<?php echo $fields['_render_']['footer'] ?>
