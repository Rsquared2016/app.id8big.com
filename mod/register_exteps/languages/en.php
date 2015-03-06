<?php

/**
 * register_exteps
 *
 * @author Bortoli German
 * @link http://community.elgg.org/profile/pedroprez
 * @copyright (c) Keetup 2010
 * @link http://www.keetup.com/
 * @license GNU General Public License (GPL) version 2
 */
$english = array(
    'register_exteps:admin' => "register_exteps's Admin Area",
    'register_exteps:admin:settings' => 'Settings',
    'register_exteps:admin:about' => 'About',
    //Translation Here
    'register_exteps:ping:title' => 'register_exteps Plugin',
    'register_exteps:ping:description' => 'Help us to improve the quality of this plugin. This program will send minimal information (elgg version, site url, name of the plugin) just once to the keetup.com servers to know the majority elgg versions the users have installed. Then we can focus on that particular versions.',
    'register_exteps:ping:description2' => 'We can also send to you a notification when we release new versions of this plugin so please add your email address',
    'register_exteps:ping:description3' => 'this will be used just to that end',
    'register_exteps:ping:thanks' => 'Thanks for help us',
    'register_exteps:ping:cancel' => 'No, thanks',
    'register_exteps:ping' => 'Yes, I want to help',
    'register_exteps:settings:gatekeeper' => 'Allow open registration ?',
    'register_exteps:no_access_registration' => "You don't have access to view this page",
    'register_exteps:welcome' => 'Welcome',
    'register_exteps:tab:step' => 'Step',
    'register_exteps:register:label:picture' => 'Profile image',
    //Step 2
    'profile:nombre' => 'Nombre',
    'profile:apellido' => 'Apellido',
    'profile:sexo' => 'Sexo',
    'profile:localidad' => 'Ciudad',
    'profile:id_provincia' => 'Provincia',
    'profile:nombre' => 'Nombre',
    'profile:documento' => 'Tipo y nº de documento',
    'profile:telefono' => 'Teléfono',
    'profile:telefono_celular' => "Teléfono Celular",
    'profile:telefono_formato' => '11 5555 5555',
    'profile:cuit' => 'Cuit',
    'profile:preferencias' => 'Preferencias',
    'profile:privacy_level' => 'Nivel de privacidad',
    'kt_form:register:label:fecha_nacimiento' => 'Fecha de nac.',
    'profile:tipo_documento:opciones' => 'Tipo de Documento',
    'register_exteps:label:gender' => 'Seleccione sexo',
    'register_exteps:label:gender:male' => 'Masculino',
    'register_exteps:label:gender:female' => 'Femenino',
    'register_exteps:label:normal:year' => 'Año',
    'register_exteps:label:month' => 'Mes',
    'register_exteps:label:day' => 'Día',
    'register_exteps:label:normal:location' => 'Location',
    'register:exteps:personal_information:success' => 'You successfully completed your personal information.',
    'register:exteps:personal_information_moderated:success' => "You successfully completed your personal information, but need an Administration review.",
    /**
     * Errors
     */
    'register_ext:error:all_fields_are_required' => 'All the fields are required, or the password must match.',
    'register:exteps:profile_icon:error' => 'You must upload a Picture !',
    'register_exteps:twitterservice:disabled' => 'The plugin twitterservice is disabled, you must enable this to view this step.',
    'register_exteps:register:label:all_fields' => 'All the fields are required',
    /**
     * Buttons
     */
    'register_exteps:buttons:next' => 'Next',
    'register_exteps:buttons:back' => 'Back',
    'register_exteps:buttons:finish' => 'Finish',
    'register_exteps:buttons:save' => 'Save',
    'profile:provincias:select_one' => 'Select city',

    /**
     * Tab informations
     */
    //Personal Information
    'register_exteps:tab_info:personal_information:title:normal' => 'Create My Profile',
    'register_exteps:tab_info:personal_information:description:normal' => 'Personal Information for normal users here.',
    'kt_form:register:label:profileicon' => 'Imagen del Perfil',
    'kt_form:register:label:submit:send:editing' => 'Guardar',
    'kt_form:register:label:submit:send:loading' => 'Guardando',
    'register_exteps:settings:dev_mode' => 'Developer Mode',
    'register_exteps:settings:dev_mode:info' => 'Developer mode, removes the completed steps security.',
    'profile:fecha_nacimiento' => 'Fecha de nac.',
    'register_exteps:profile_icon:note' => 'Image format JPG, GIF or PNG (max size. 2 MB)',
    'register:exteps:professional_information:error' => 'There were an error while trying to save the DNI.',
    'register:exteps:professional_information:helper' => 'Este dato facilita notablemente la asociación de tu identidad virtual con tu identidad civil a la hora de presentar pruebas de autoría. NO SERÁ un dato accesible al público.',
    'welcome_site:widgets:first_steps:title' => 'Objetivos',
    'welcome_site:widgets:first:steps:register' => "Registrarse",
    'welcome_site:widgets:first:steps:edit:icon' => "Cargar imagen",
    'welcome_site:widgets:first:steps:basic:data' => "Datos básicos",
    'welcome_site:widgets:first:steps:add:obra' => "Crear mi primer obra",
    'welcome_site:widgets:first:steps:dni' => 'Cargar DNI',

    'register_exteps:validate:exception' => 'The field %s is required',

    'register_exteps:required:fields' => 'All fields marked with a * are required',
    'register_exteps:tab_info:create_acount' => 'Create My Account',
	'register_exteps:tab_info:start_using' => 'Start Using',
	'register_exteps:register:info:title' => 'Our Pledge',
	'register_exteps:register:info:1' => 'We won\'t spam you.',
	'register_exteps:register:info:2' => 'We respect your privacy.',
	'register_exteps:register:info:3' => 'Linking to other social networks is done as a convenience.',
    'register_exteps:register:info:4' => 'You control all communications with your friends and contacts.',
	'register_exteps:register:info:5' => 'We value you.',
    'register_exteps:personal_information:max_length' => 'Note: Maximum of %s characters.',
    'register_exteps:personal_information:info:title' => 'Tell us more about yourself to better connect with other inspiring entrepreneurs.',
);

add_translation("en", $english);
