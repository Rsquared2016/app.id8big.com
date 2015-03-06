<?php

/**
 * kt_polls
 *
 * @author Bortoli German
 * @link http://community.elgg.org/profile/pedroprez
 * @copyright (c) Keetup 2010
 * @link http://www.keetup.com/
 * @license GNU General Public License (GPL) version 2
 */
$spanish = array(
	/**
	 * Default translations
	 */
	'kt_polls:admin' => "Administrar Encuestas",
	'kt_polls:admin:settings' => 'Configuración',
	'kt_polls:admin:about' => 'Acerca de',
	'item:object:kt_poll' => 'Encuesta',
	'kt_polls' => 'Encuestas',
	//Translation Here
	'kt_polls:ping:title' => 'Encuestas Plugin',
	'kt_polls:ping:description' => 'Ayúdanos a mejorar la calidad de este plugin. Este programa enviará la información mínima (versión Elgg, url del sitio, nombre del plugin) una sola vez a los servidores keetup.com saber que la mayoría de los usuarios elgg versiones instaladas. A continuación, podemos centrarnos en que las versiones particulares.',
	'kt_polls:ping:description2' => 'También podemos enviarle una notificación cuando soltamos nuevas versiones de este plugin por favor añadir su dirección de correo electrónico',
	'kt_polls:ping:description3' => 'este se utilizará sólo para ese fin',
	'kt_polls:ping:thanks' => 'Gracias por ayudarnos',
	'kt_polls:ping:cancel' => 'No, gracias',
	'kt_polls:ping' => 'SI, quiero colaborar',
	'kt_polls:plugin:title' => 'Encuestas',
	'kt_polls:plugin:listing:title' => 'Listado de Encuestas',
	'kt_polls:plugin:menu:title' => 'Encuestas',
	'kt_polls:plugin:friendly_title' => 'Encuestas',
	'kt_polls:plugin:page_owner:list' => 'Encuestas del sitio',
	'kt_polls:plugin:page_owner:add' => 'Agregar una Encuesta',
	'kt_polls_ktform:sorteable:link:first' => 'Orden 1',
	'kt_polls_ktform:sorteable:link:second' => 'Orden 2',
	'kt_polls_ktform:sorteable:link:third' => 'Orden 3',
	'kt_polls_ktform:sorteable:link:tags' => 'Etiquetas',
	/**
	 * Editable menus
	 */
	'kt_polls:add:title' => 'Agregar una Encuesta',
	'kt_polls:edit:title' => 'Editar la Encuesta %s',
	/**
	 * Form labels text
	 */
	'kt_polls:kt_polls:label:image' => 'Imagen principal',
	'kt_polls:kt_polls:label:title' => 'Título',
	'kt_polls:kt_polls:label:name' => 'Nombre',
	'kt_polls:kt_polls:label:description' => 'Descripción',
	'kt_polls:kt_polls:label:tags' => 'Etiquetas',
	'kt_polls:kt_polls:label:access_id' => 'Acceso',
	'kt_polls:kt_polls:label:shortdescription' => 'Breve Descripción',
	'kt_polls:kt_polls:info_text:description' => 'Añada una descripción a Encuesta.',
	'kt_polls:kt_polls:info_text:shortdescription' => 'Esta es una breve descripción',
	'kt_polls:kt_polls:label:submit:send' => 'Guardar',
	'kt_polls:kt_polls:label:submit:send:editing' => 'Editar',
	'kt_polls:kt_polls:label:submit:send:loading' => 'Guardando ...',
	/**
	 * Form labels text demo
	 */
	'kt_polls:kt_polls:label:dummie_autocomplete' => 'Autocompletado',
	'kt_polls:kt_polls:label:dummie_checkboxes' => 'Casillas de verificación',
	'kt_polls:kt_polls:label:dummie_date' => 'Fecha',
	'kt_polls:kt_polls:label:dummie_dropdown' => 'Lista desplegable',
	'kt_polls:kt_polls:label:dummie_email' => 'Email',
	'kt_polls:kt_polls:label:location' => 'Localización',
	'kt_polls:kt_polls:label:dummie_radios' => 'Botones de opción',
	'kt_polls:kt_polls:label:dummie_tag' => 'Etiqueta',
	'kt_polls:kt_polls:label:dummie_url' => 'URL',
	'kt_polls:kt_polls:label:members' => 'Miembros',
	'kt_polls:kt_polls:label:other_image' => 'Otra imagen',
	/**
	 * Search form labels
	 */
	'kt_polls:kt_polls_filter:label:keyword' => 'Palabra clave',
	'kt_polls:kt_polls_filter:label:owner' => 'Propietario',
	'kt_polls:kt_polls_filter:label:submit:send' => 'Buscar',
	'kt_polls:kt_polls_filter:label:submit:send:loading' => 'Buscar',
	'kt_polls_ktform:entities:kt_poll:listing:empty_results' => 'No existen Encuestas aún.',
	'kt_polls:sort:title' => 'Ordenar por',
	/**
	 * River text
	 */
	'kt_polls:river:created' => '%s creada',
	'kt_polls:river:updated' => '%s actualizada',
	'kt_polls:river:create' => 'una Encuesta',
	'kt_polls:river:annotate' => 'un comentario en',
	'river:comment:object:kt_poll' => '%s comento en %s',
	'kt_polls:listing:link:add' => 'Agregar',
	'kt_polls:listing:link:search' => 'Buscar',
	'kt_polls:add' => 'Agregar una Encuesta',
	'kt_polls:form:footer:has_required_fields' => '* Campos requeridos',
	'kt_polls:plugin:listing:friends' => "Encuestas de Amigos",
	'kt_polls:plugin:listing:mine' => "Encuestas de %s",
	/**
	 * Widget text 
	 */
	'kt_polls:widget:description' => "Muestre sus últimas Encuestas",
	'kt_polls:more' => 'Ver mas',
	'kt_polls:none' => 'No existen Encuestas',
	 
	 
	 'kt_polls:group' => 'Grupo de kt_polls',
	 'kt_polls:enablekt_polls' => 'Habilitar Encuestas de grupo',
	'kt_polls:group_support' => 'Habilitar soporte de grupo',
	'kt_polls:enable_rivers_items' => 'Habilitar la creación de Items de actividad',
	'kt_polls:profile_label_above' => 'Etiquetas de perfil encima de los campos',
	'kt_polls:option:no' => 'No',
	'kt_polls:option:yes' => 'Si',
);

add_translation("es", $spanish);