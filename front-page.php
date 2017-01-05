<?php

get_header();

if (have_posts()):
    while (have_posts()) : the_post(); ?>
    
    <article class="post page">

        <?php
        if( has_children() OR $post->post_parent > 0) { ?>
    
            <nav class="site-nav children-links clearfix">
    
                <span class="parent-link"><a href="<?php echo get_the_permalink(get_top_ancestor_id()); ?>"><?php echo get_the_title(get_top_ancestor_id()); ?>
        
                </a></span>    
        
                <ul>
                    <?php
                    $args = array(
                        'child_of' => get_top_ancestor_id(),
                        'title_li' => ''
                    );
                    ?>
            
                    <?php wp_list_pages($args); ?>
                </ul>
            </nav>

        <?php } ?>

        <?php the_content(); ?>
    </article>
    
   <?php endwhile;

else :
    echo '<p>No content found</p>';

endif; ?>

<div class="home-columns clearfix">

    <div class="one-half">
        <?php // opinion posts loop begins here
        $args = array (
            'category_name' => 'news',
            'posts_per_page' => 2,
            'orderby' => 'title',
            'order' => 'ASC'
        );
        $opinionPosts = new WP_Query($args);
        //$opinionPosts = new WP_Query('cat=10&posts_per_page=2&orderby=title&order=ASC');

        if ($opinionPosts->have_posts()) :
        
            while ($opinionPosts->have_posts()) : $opinionPosts->the_post();
                ?>
                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <?php the_excerpt(); ?>
            <?php endwhile;  
            
            else :
                //fallback no content message
        endif;
        wp_reset_postdata(); ?>

    </div>

    <div class="one-half last">
        <?php // news posts loop begins here
        $newsPosts = new WP_Query('cat=1&posts_per_page=2&orderby=title&order=ASC');
        
        if ($newsPosts->have_posts()) :
        
            while ($newsPosts->have_posts()) : $newsPosts->the_post();
                ?>
                <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                <?php the_excerpt(); ?>
            <?php endwhile;  
            
            else :
                //fallback no content message
        endif;
        wp_reset_postdata(); ?>

    </div>

</div>

<?php
echo setAndViewPostViews(get_the_ID());
 
get_footer();

?>
