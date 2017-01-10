<?php

get_header();

if (have_posts()):
    while (have_posts()) : the_post(); ?>
    
    <article class="post page">

        <?php the_content(); ?>
    </article>
    
   <?php endwhile;

else :
    echo '<p>No content found</p>';

endif; ?>

<div class="home-columns clearfix">

    <div class="one-half">
        <?php // Branches display begins here
        $catStrings = array ('computer-science', 'electrical', 'biology', 'wordpress',
                        'physics', 'mathematics', 'history' 
        );
        $separator = " ";
        $output = '<nav class="site-nav site-header-nav departments-nav clearfix"> <ul>';
        foreach ($catStrings as $category) {
            $catId = get_category_by_slug($category);
            $output .= '<li><a href="' . get_category_link($catId->term_id) . '" class = "btn-element">' . $catId->cat_name . '</a></li>' . $separator;
        }
        echo trim($output, $separator).'</nav></ul>';
        ?>
    </div>

    <div class="one-half last">
        <?php // news posts loop begins here
        $newsPosts = new WP_Query('orderby=title&order=ASC');
        
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
