<?php

function university_files() {
  wp_enqueue_script('main-script',get_theme_file_uri( '/build/index.js' ) ,array('jquery'),'1.0',true);
  wp_enqueue_style('google-fonts','//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
  wp_enqueue_style('font-awesome','//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
  wp_enqueue_style('university_main_styles', get_theme_file_uri('/build/style-index.css'));
  wp_enqueue_style('university_extrq_styles', get_theme_file_uri('/build/index.css'));
} 
function university_features(){
  add_theme_support('title-tag') ;
}


add_action('wp_enqueue_scripts', 'university_files');
add_action( 'after_setup_theme', 'university_features' ) ;

function university_adjust_queries($query) {
  $today = date('Ymd');
  if(!is_admin(  ) AND is_post_type_archive( 'event' ) AND $query->is_main_query(  )){
    $query->set('meta_key','event_date');
    $query->set('orderby','meta_value_num');
    $query->set('order','DESC');
    $query->set('meta_query',array(
      'key'=>'event_date',
      'value'=>$today,
      'compare'=>'>=',
      'type'=>'numeric'
    ));
  }
};