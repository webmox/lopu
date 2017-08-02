<?php
/*--------------добавления нового пункта меню в админ панель-------------*/

function page_settings_theme(){
	add_theme_page(
		'Страница настройки темы',
		'Настройка Park',
		'administrator',
		'park',
		'show_page_settings_park'
	);
}

add_action('admin_menu', 'page_settings_theme');

/*-------------функция отображающая содержимое страницы настройки темы------------*/

function show_page_settings_park(){
	?>
		<!--Создаем заголовок в стандартном контейнере wrap-->
		<div class="wrap">
		<!--добавляем иконки к странице-->
		<div id="icon-themes" class="icon32"></div>  
		<h2>Настройки темы TPP</h2>

		  <!-- Делаем вызов функции WordPress для вывода ошибок, возникающих при сохранении настроек. -->  
        <?php settings_errors(); ?>  

        <!-- Создаем форму, которая будет использоваться для вывода наших опций -->
        <form method="post" action="options.php">
        	<?php settings_fields('park'); ?>
        	<?php do_settings_sections('park'); ?>
        	<?php submit_button(); ?>
        </form>
		</div><!--end wrap-->
	<?php
}


function mytheme_settings(){
	add_settings_section(  
        'general_settings_section',           // ID, который будет использоваться для идентификации этой секции и по которому мы будем регистрировать опции
        'Контактная информация',                      // Заголовок, который будет отображаться на странице административной панели
        'show_field_settings',   // Вызов, который используется для отображения описания секции  
        'park'                             // Страница, на которую будет добавлена секция  
    );  



	  /*------регистрируем текстовое поле для первого телефона-------*/
	add_settings_field(
		'phone1',
		'Телефон №1:',
		'show_content_phone1',
		'park',
		'general_settings_section'
	);

	 register_setting(
	 	'park',
	 	'phone1'
	 );


	  /*------регистрируем текстовое поле для второго телефона-------*/
	add_settings_field(
		'phone2',
		'Телефон №2:',
		'show_content_phone2',
		'park',
		'general_settings_section'
	);

	 register_setting(
	 	'park',
	 	'phone2'
	 );
}

add_action('admin_init', 'mytheme_settings');


/*-----------функция отображающая содержимое в секции---------*/

function show_field_settings(){
	echo "<p>В данном разделе вы можете добавить контактную информацию, которая будет отображаться на сайте.</p>";
}


/*--------------вывод текстового поля для первого телефона-----------*/
function show_content_phone1(){
	$country = get_option('phone1');
	$country_field = "<input type='text' id='phone1' class='regular-text'  name='phone1' value='".get_option('phone1')."' />";
	echo $country_field;
}

/*--------------вывод текстового поля для второго телефона-----------*/
function show_content_phone2(){
	$country = get_option('phone2');
	$country_field = "<input type='text' id='phone2' class='regular-text'  name='phone2' value='".get_option('phone2')."' />";
	echo $country_field;
}

 ?>