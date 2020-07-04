<?php
/**
 * Plugin Name: dds-banner
 * Description: Выводит карусель баннеров на главной странице сайта
 * Plugin URI:  https://github.com/alexanderkulnyow/dds-banner
 * Author URI:  https://dds.by/
 * Author:      alexander kulnyow
 *
 * Text Domain: dds-banner
 * Domain Path: Путь до MO файла (относительно папки плагина)
 *
 * Requires PHP: 5.4
 * Requires at least: 2.5
 *
 * License:     GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 *
 * Network:     true - активирует плагин для всей сети
 * Version:     1.0
 */

/*
|--------------------------------------------------------------------------
| FILTERS
|--------------------------------------------------------------------------
*/

add_filter( 'init', 'register_post_types' );


/*
|--------------------------------------------------------------------------
| DEFINE THE CUSTOM POSTTYPE
|--------------------------------------------------------------------------
*/

/**
 * Setup dds-banner Custom Posttype
 *
 * @since       1.0
 */

function register_post_types() {
	register_post_type( 'dds-banner', array(
		'label'              => null,
		'labels'             => array(
			'name'               => 'Баннер', // основное название для типа записи
			'singular_name'      => 'Баннер', // название для одной записи этого типа
			'add_new'            => 'Добавить баннер', // для добавления новой записи
			'add_new_item'       => 'Добавление баннера', // заголовка у вновь создаваемой записи в админ-панели.
			'edit_item'          => 'Редактирование баннера', // для редактирования типа записи
			'new_item'           => 'Новый баннер', // текст новой записи
			'view_item'          => 'Смотреть баннер', // для просмотра записи этого типа.
			'search_items'       => 'Искать ____', // для поиска по этим типам записи
			'not_found'          => 'Не найдено', // если в результате поиска ничего не было найдено
			'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
			'menu_name'          => 'Баннеры', // название меню
		),
		'description'        => '',
		'public'             => true,
		'publicly_queryable' => true,
		// зависит от public
		// 'exclude_from_search' => null, // зависит от public
		'show_ui'            => true,
		// зависит от public
		// 'show_in_nav_menus'   => null, // зависит от public
		'show_in_menu'       => false,
		// показывать ли в меню адмнки
		// 'show_in_admin_bar'   => null, // зависит от show_in_menu
		'show_in_rest'       => null,
		// добавить в REST API. C WP 4.7
		'rest_base'          => null,
		// $post_type. C WP 4.7
		'menu_position'      => 5,
		'menu_icon'          => 'dashicons-images-alt2',
		'capability_type'    => 'post',
//		'capabilities'      => 'menus', // массив дополнительных прав для этого типа записи
		'map_meta_cap'       => true,
		// Ставим true чтобы включить дефолтный обработчик специальных прав
		'hierarchical'       => false,
		'supports'           => [ 'title','excerpt', 'thumbnail' ],
		// 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
		'taxonomies'         => array(),
		'has_archive'        => false,
		'rewrite'            => true,
		'query_var'          => true,
	) );
}
