<?php 
add_action( 'wp_enqueue_scripts', 'my_theme_enqueue_styles' );
function my_theme_enqueue_styles() {
    $parenthandle = 'parent-style'; // This is 'twentyfifteen-style' for the Twenty Fifteen theme.
    $theme = wp_get_theme();
    wp_enqueue_style( $parenthandle, get_template_directory_uri() . '/style.css', 
        array(),  // if the parent theme code has a dependency, copy it to here
        $theme->parent()->get('Version')
    );
    wp_enqueue_style( 'child-style', get_stylesheet_uri(),
        array( $parenthandle ),
        $theme->get('Version') // this only works if you have Version in the style header
    );
}



add_filter( 'manage_product_posts_columns', 'set_custom_edit_book_columns');
function set_custom_edit_book_columns($columns,$post_id) { 
    $columns['status'] = __( 'סטָטוּס', ' ' ); //show header of column of the table
    return $columns;
} 

add_action( 'manage_product_posts_custom_column', 'visibility_product_column_content', 10, 2 );
function visibility_product_column_content( $column,$post_id  ){
    $status = get_field('status',$post_id,true);
    if($column == 'status'){
        if($status=='sold'){
                echo 'נמכר';
        }
        else if($status=='new'){
            echo 'חדש'; }
        else if($status=='stock'){
            echo 'במלאי';
        }else{
            
        }
    } 
}     
