<?php

/**
 * Gtask
 *
 * Class description here or bellow...
 * 
 * @author [author]
 * @link http://community.elgg.org/profile/pedroprez
 * @copyright (c) Keetup 2010
 * @link http://www.keetup.com/
 * @license GNU General Public License (GPL) version 2
 * 
 * 
 * -- IMPORTANT * IMPORTANT * IMPORTANT * IMPORTANT * IMPORTANT * IMPORTANT * IMPORTANT * 
 * 
 * 		- FOR EXAMPLE OF IMPLEMENTATION SEE THE FUNCTION @gtask_fields_demo_hook()
 * 
 * -- IMPORTANT * IMPORTANT * IMPORTANT * IMPORTANT * IMPORTANT * IMPORTANT * IMPORTANT * 
 * 
 * 		- TO REMOVE THE DEMO MODE SET TO FALSE THE CONSTANT Gtask_ENABLE_DEMO
 */
class GtaskForm extends GtaskBaseForm {

    public function __construct($form_vars = array()) {

        $form_vars['plugin_name'] = 'gtask';

        parent::__construct($form_vars);

        $this->setTypes('object', 'gtask');

        $is_group = FALSE;
        
        $access_id = ACCESS_PRIVATE;
        $container = elgg_get_page_owner_entity();
        if ($container instanceof ElggGroup) {
            $is_group = TRUE;
            $access_id = $container->group_acl;
            $container_guid = $container->getGUID();
        }
        else {
            $container_guid = get_input('container_guid');
            if ($container_guid) {
                $container = get_entity($container_guid);
                if ($container instanceof ElggGroup) {
                    $is_group = TRUE;
                }
            }
        }

        $default_date = strtotime(date("Y-m-d", strtotime(date("Y-m-d"))) . " +1 month");

        //$this->setFormGroupLabels(array('a' => 'Hola', 'c' => 'El Grupo C esta presente jejeje'));
        //If you have to upload files, uncomment this line
        $this->setFormFileSupport();

        $fields = array(
//			'image' => array(
//				'type' => 'image',
//				'container_group' => 'a',
//				'validators' => array('file' => array('required' => TRUE, 'mimetype' => "web_images", 'max_size' => '200067')),
//			),
            'title' => array(
                'type' => 'text',
                'input_class' => 'txtFrm txtFrm100',
                'validators' => array('required' => TRUE),
                'container_group' => 'b',
            ),
            'description' => array(
                'type' => 'longtext',
                'label' => TRUE,
                'validators' => array('required' => TRUE),
                'container_group' => 'b',
            ),
            'responsive' =>
            array(
                'type' => 'pulldown',
                'input_class' => 'txtFrm txtFrm100',
                'options' => array(
                    'options_values' => gtask_get_responsive_options($container_guid),
                ),
//					'validators' => array('required' => TRUE),
            ),
            'status' => array(
                'type' => 'pulldown',
                'options' => array(
                    'options_values' => gtask_get_status_options(),
                ),
                'default_value' => 'onhold',
            ),
            'priority' => array(
                'type' => 'priority_checkbox',
                'input_class' => 'checkBoxFrm',
//					'wrapper_class' => 'ktFormWrapper checkBoxFrmLabel bottomLineBreak',
                'options' => array(
                    'options' => array(
                        elgg_echo('gtask:priority:high') => 3,
                    ),
                ),
//					'wrapper_class' => 'ktFormWrapper checkBoxFrmLabel',
            ),
            'calendar_end' => array(
                'type' => 'deadline',
                'default_value' => $default_date,
//				'validators' => array('date_range' => TRUE), //some regexp
            ),
//			'tags' => array(
//				'type' => 'tags',
//				'container_group' => 'c',
//				//'validators' => array('value_filter' => array('exp' => 'image')), //some regexp
//				'process_as' => 'array', //This will process the form as array, if you do not pass any array as input, then will strip tags to array
//			),
            'access_id' => array(
                'type' => 'access',
                'container_group' => 'z',
                'default_value' => $access_id,
            ),
        );
        
        if (!$is_group) {
            if ($container instanceof ElggUser) {
//                unset($fields['responsive']);
                $fields['responsive'] = array(
                    'type' => 'hidden',
                    'default_value' => elgg_get_logged_in_user_guid(),
                    'label' => FALSE,
                    'wrapper_class' => 'hidden',
                );
            }
        }
        
        $this->setFields($fields);
    }

}