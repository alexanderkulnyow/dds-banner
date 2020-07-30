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


add_filter( 'init', 'register_dds_banner_post_types' );

//function my_remove_wp_seo_meta_box() {
//	remove_meta_box( 'wpseo_meta', 'post_type_name', 'normal' );
//}
//add_action( 'add_meta_boxes', 'my_remove_wp_seo_meta_box', 100 );

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

function register_dds_banner_post_types() {
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
		'show_in_menu'       => true,
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
		'supports'           => [ 'title', 'excerpt', 'thumbnail' ],
		// 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
		'taxonomies'         => array(),
		'has_archive'        => false,
		'rewrite'            => true,
		'query_var'          => true,
	) );
}

function dds__banner() {
	global $id;
	?>
    <div id="Wp_Bootstrap_Carousel" class="row carousel slide" data-ride="carousel">
		<?php
		$count__publish = wp_count_posts( 'dds-banner' )->publish;


        if($count__publish > 1 ) {
            ?>
            <ol class="carousel-indicators">
		        <?php
		        $args  = array(
			        'post_type' => 'dds-banner',
		        );
		        $query = new WP_Query( $args );
		        ?>
		        <?php if ( $query->have_posts() ) : ?>
			        <?php $i = 0; ?>
			        <?php while ( $query->have_posts() ) : $query->the_post() ?>
                        <li data-target="#Wp_Bootstrap_Carousel" data-slide-to="<?php echo $i ?>"
                            class="<?php if ( $i === 0 ): ?>active<?php endif; ?>"></li>
				        <?php $i ++; ?>
			        <?php endwhile ?>
		        <?php endif ?>
		        <?php wp_reset_postdata(); ?>
            </ol>

            <!-- Controls -->
            <a class="carousel-control-prev" href="#Wp_Bootstrap_Carousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#Wp_Bootstrap_Carousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
            <?php
        }?>



        <div class="carousel-inner" role="listbox">
			<?php
			$args  = array(
				'post_type' => 'dds-banner',
			);
			$query = new WP_Query( $args );
			?>
			<?php if ( $query->have_posts() ) : ?>
				<?php $i = 0; ?>
				<?php while ( $query->have_posts() ) : $query->the_post() ?>
                    <div class="carousel-item <?php if ( $i === 0 ): ?>active<?php endif; ?>">
                        <img class="img-fluid"
                             style="width: 100vw; height: auto;"
                             src="<?php echo get_the_post_thumbnail_url( $id, 'full' ); ?>"
                             srcset="<?php echo get_the_post_thumbnail_url( $id, 'full' ); ?> 1920w,
	                        				<?php echo get_the_post_thumbnail_url( $id, 'shop_catalog' ); ?> 768w"
                             sizes="(max-width: 800px) 768w, (min-width: 801px) 1920px"
                             alt="Ресторан-клуб Танцы">
                    </div>
					<?php $i ++; ?>
				<?php endwhile ?>
			<?php endif ?>
			<?php wp_reset_postdata(); ?>
        </div>


    </div>
	<?php

}
