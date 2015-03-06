Maquetado:
--------------
* [theme_plugin] Hace referencia al nombre del plugin nuevo del theme.
* Para maquetar el nuevo theme se debe basar en el theme_professionalelgg
* En caso de: 
	* Agregar nuevo CSS, se debe agregar en css/[theme_plugin]/custom.php
		Esta vista va a extender el css definido en el theme.

	* Necesitar realizar un cambio en algun css o vista del theme, simplemente se copia
	la vista del theme en algunas de las carpetas que estan dentro de [theme_plugin]/views/default/css/*
	Ej: 
		- Queremos modificar un css que esta en la vista css/elements/layout.php 
		(del plugin professionalelgg)
		1. Vamos al plugin professionalelgg y copiamos la vista dentro del [theme_plugin]/views/default/css/*,
		 dentro de la misma estructura.
		2. Realizamos los cambios en ese archivo.
		3. Esta vista va a pisar la vista que esta definida en el theme.


Sugerencias:
------------
- Para empezar a trabajar deberiamos copiar:
	1. Vista setup que define los colores del sitio de 
		theme_professionalelgg/views/default/css/theme_professionalelgg/setup.php en 
		a [theme_plugin]/views/default/css/theme_professionalelgg/setup.php en 

		Al copiar este archivo los colores son editables desde las settings del theme_professionalelgg

	2. Maquetar la home en:
		mod/[theme_plugin]/views/default/page/layouts/home_site_index.php

		Al realizar el maquetado en esta seccion la misma es editable a traves de las settings del 
		theme_professionalelgg.