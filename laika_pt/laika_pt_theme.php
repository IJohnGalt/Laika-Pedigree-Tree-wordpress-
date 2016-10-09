<?php

get_header(); ?>

<div id="primary">
<div id="content" role="main">
<?php while ( have_posts() ) : the_post(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
<header class="entry-header">
  <strong><h2 class="entry-title"><?php the_title(); ?></h2></strong><br />

<?php the_post_thumbnail( 'large' ); ?>
<div class="entry-content">
<?php	
$laika_css = get_option('laika_pt_default', 0);
if ($laika_css == 1){
?>
<link rel="stylesheet" type="text/css" href=<?php echo plugin_dir_url( $file ).'laika_pt/laika.css'; ?> media="screen" />
<?php } ?>	
</header>

<?php the_content(); ?><br />




<?php


$this_post_id=get_the_ID();
$this_post_title=get_the_title();
$this_post_link=get_permalink();
$this_post_ident_meta=esc_html(trim( get_post_meta( get_the_id(),'laika_pt_code', true )) );
$this_post_mum_ident_meta= esc_html(trim ( get_post_meta( get_the_id(),'laika_pt_mum', true ) ));
$this_post_dad_ident_meta= esc_html(trim ( get_post_meta( get_the_id(),'laika_pt_dad', true ) ));
?>
 <?php


$i = 0;
$laika_generations = get_option('laika_pt_generations', 3);
$laikaempty = get_option('laika_pt_empty', '-');
//loop through pets
$args = array('post_type' => 'laika_pt_type');
$your_query = new WP_Query($args);
while ( $your_query->have_posts() ) : $your_query->the_post();

  //variables that we will display after the loop;
  $post_id[$i]=get_the_ID();
  if ($post_id[$i]==$this_post_id ){


  }
  $post_title[$i]=get_the_title();
  $post_link[$i]=get_permalink();
  $post_id0[$i] = get_the_ID();
  $post_ident_meta[$i]=esc_html(trim( get_post_meta( get_the_ID(),'laika_pt_code', true )) );
  $post_mum_ident_meta[$i]= esc_html(trim ( get_post_meta( get_the_ID(),'laika_pt_mum', true ) ));
  $post_dad_ident_meta[$i]= esc_html(trim ( get_post_meta( get_the_ID(),'laika_pt_dad', true ) ));


$i++;
//end pets loop
endwhile;
endwhile;
wp_reset_postdata();

//first parents generation
for ($j=0;$j<sizeof($post_id);$j++){
  if ($post_id[$j] !== $this_post_id){
    if($post_ident_meta[$j] == $this_post_mum_ident_meta){
      $mum1_title = $post_title[$j];
      $mum1_ident = $post_ident_meta[$j];
      $mum1_link = $post_link[$j];
      $mum1_mum1_ident = $post_mum_ident_meta[$j];
      $dad1_mum1_ident = $post_dad_ident_meta[$j];

    }

    if($post_ident_meta[$j] == $this_post_dad_ident_meta){
      $dad1_title = $post_title[$j];
      $dad1_ident = $post_ident_meta[$j];
      $dad1_link = $post_link[$j];
      $mum1_dad1_ident = $post_mum_ident_meta[$j];
      $dad1_dad1_ident = $post_dad_ident_meta[$j];


      }

  }

}

//second parents generation
for ($j=0;$j<sizeof($post_id);$j++){
    if($post_ident_meta[$j] == $mum1_mum1_ident){
      $mum1_mum1_title = $post_title[$j];
      $mum1_mum1_link = $post_link[$j];
      $mum1_mum1_mum1_ident = get_post_meta($post_id0[$j], 'laika_pt_mum', true);
      $dad1_mum1_mum1_ident = get_post_meta($post_id0[$j], 'laika_pt_dad', true);
    }
    if($post_ident_meta[$j] == $dad1_mum1_ident){
      $dad1_mum1_title = $post_title[$j];
      $dad1_mum1_link = $post_link[$j];
      $mum1_dad1_mum1_ident = get_post_meta($post_id0[$j], 'laika_pt_mum', true);
      $dad1_dad1_mum1_ident = get_post_meta($post_id0[$j], 'laika_pt_dad', true);
    }
    if($post_ident_meta[$j] == $mum1_dad1_ident){
      $mum1_dad1_title = $post_title[$j];
      $mum1_dad1_link = $post_link[$j];
      $mum1_mum1_dad1_ident = get_post_meta($post_id0[$j], 'laika_pt_mum', true);
      $dad1_mum1_dad1_ident = get_post_meta($post_id0[$j], 'laika_pt_dad', true);
    }
    if($post_ident_meta[$j] == $dad1_dad1_ident){
      $dad1_dad1_title = $post_title[$j];
      $dad1_dad1_link = $post_link[$j];
      $mum1_dad1_dad1_ident = get_post_meta($post_id0[$j], 'laika_pt_mum', true);
      $dad1_dad1_dad1_ident = get_post_meta($post_id0[$j], 'laika_pt_dad', true);
    }
}

//third parents generation
for ($j=0;$j<sizeof($post_id);$j++){
    if($post_ident_meta[$j] == $mum1_mum1_mum1_ident){
      $mum1_mum1_mum1_title = $post_title[$j];
      $mum1_mum1_mum1_link = $post_link[$j];
    }
}

for ($j=0;$j<sizeof($post_id);$j++){
    if($post_ident_meta[$j] == $dad1_mum1_mum1_ident){
      $dad1_mum1_mum1_title = $post_title[$j];
      $dad1_mum1_mum1_link = $post_link[$j];
    }
}

for ($j=0;$j<sizeof($post_id);$j++){
    if($post_ident_meta[$j] == $mum1_dad1_mum1_ident){
      $mum1_dad1_mum1_title = $post_title[$j];
      $mum1_dad1_mum1_link = $post_link[$j];
    }
}

for ($j=0;$j<sizeof($post_id);$j++){
    if($post_ident_meta[$j] == $dad1_dad1_mum1_ident){
      $dad1_dad1_mum1_title = $post_title[$j];
      $dad1_dad1_mum1_link = $post_link[$j];
    }
}

for ($j=0;$j<sizeof($post_id);$j++){
    if($post_ident_meta[$j] == $mum1_mum1_dad1_ident){
      $mum1_mum1_dad1_title = $post_title[$j];
      $mum1_mum1_dad1_link = $post_link[$j];
    }
}

for ($j=0;$j<sizeof($post_id);$j++){
    if($post_ident_meta[$j] == $dad1_mum1_dad1_ident){
      $dad1_mum1_dad1_title = $post_title[$j];
      $dad1_mum1_dad1_link = $post_link[$j];
    }
}

for ($j=0;$j<sizeof($post_id);$j++){
    if($post_ident_meta[$j] == $mum1_dad1_dad1_ident){
      $mum1_dad1_dad1_title = $post_title[$j];
      $mum1_dad1_dad1_link = $post_link[$j];
    }
}

for ($j=0;$j<sizeof($post_id);$j++){
    if($post_ident_meta[$j] == $dad1_dad1_dad1_ident){
      $dad1_dad1_dad1_title = $post_title[$j];
      $dad1_dad1_dad1_link = $post_link[$j];
    }
}





//end of getting variables, now we display them

//1 gen
if ($laika_generations == 1 ){
echo '<div id="laikatree1">';
echo '</div>';

}
if ($laika_generations == 2 ){
echo '<div id="laikatree2">';
echo '</div>';
}


echo '<div id="laikagen1">';
if (isset($mum1_title)){
echo '<div class="laikagen1f"><a href="'.$mum1_link.'">'.$mum1_title. '</a><br/></div>';}
else{echo '<div class="laikagen1f">'.$laikaempty.'</br></div>';}
if (isset($dad1_link)){
echo '<div class="laikagen1m"><a href="'.$dad1_link.'">'.$dad1_title. '</a><br/></div>';}
else{echo '<div class="laikagen1m">'.$laikaempty.'</br></div>';}
echo '</div>';

//2 gen

if ($laika_generations > 1 ){
echo '<div id="laikagen2">';
if (isset($mum1_mum1_title)){
echo '<div class="laikagen2f"><a href="'.$mum1_mum1_link.'">'.$mum1_mum1_title. '</a><br/></div>';}
else{echo '<div class="laikagen2f">'.$laikaempty.'</br></div>';}
if (isset($dad1_mum1_title)){
echo '<div class="laikagen2m"><a href="'.$dad1_mum1_link.'">'.$dad1_mum1_title. '</a><br/></div>';}
else{echo '<div class="laikagen2m">'.$laikaempty.'</br></div>';}
if (isset($mum1_dad1_title)){
echo '<div class="laikagen2f"><a href="'.$mum1_dad1_link.'">'.$mum1_dad1_title. '</a><br/></div>';}
else{echo '<div class="laikagen2f">'.$laikaempty.'</br></div>';}
if (isset($dad1_dad1_title)){
echo '<div class="laikagen2m"><a href="'.$dad1_dad1_link.'">'.$dad1_dad1_title. '</a><br/></div>';}
else{echo '<div class="laikagen2m">'.$laikaempty.'</br></div>';}
echo '</div>';
}

// 3gen:

if ($laika_generations > 2){
echo '<div id="laikagen3">';
if (isset($mum1_mum1_mum1_title)){
echo '<div class="laikagen3f"><a href="'.$mum1_mum1_mum1_link.'">'.$mum1_mum1_mum1_title. '</a><br/></div>';}
else{echo '<div class="laikagen3f">'.$laikaempty.'</br></div>';}

if (isset($dad1_mum1_mum1_title)){
echo '<div class="laikagen3m"><a href="'.$dad1_mum1_mum1_link.'">'.$dad1_mum1_mum1_title. '</a><br/></div>';}
else{echo '<div class="laikagen3m">'.$laikaempty.'</br></div>';}

if (isset($mum1_dad1_mum1_title)){
echo '<div class="laikagen3f"><a href="'.$mum1_dad1_mum1_link.'">'.$mum1_dad1_mum1_title. '</a><br/></div>';}
else{echo '<div class="laikagen3f">'.$laikaempty.'</br></div>';}

if (isset($dad1_dad1_mum1_title)){
echo '<div class="laikagen3m"><a href="'.$dad1_dad1_mum1_link.'">'.$dad1_dad1_mum1_title. '</a><br/></div>';}
else{echo '<div class="laikagen3m">'.$laikaempty.'</br></div>';}


if (isset($mum1_mum1_dad1_title)){
echo '<div class="laikagen3f"><a href="'.$mum1_mum1_dad1_link.'">'.$mum1_mum1_dad1_title. '</a><br/></div>';}
else{echo '<div class="laikagen3f">'.$laikaempty.'</br></div>';}

if (isset($dad1_mum1_dad1_title)){
echo '<div class="laikagen3m"><a href="'.$dad1_mum1_dad1_link.'">'.$dad1_mum1_dad1_title. '</a><br/></div>';}
else{echo '<div class="laikagen3m">'.$laikaempty.'</br></div>';}

if (isset($mum1_dad1_dad1_title)){
echo '<div class="laikagen3f"><a href="'.$mum1_dad1_dad1_link.'">'.$mum1_dad1_dad1_title. '</a><br/></div>';}
else{echo '<div class="laikagen3f">'.$laikaempty.'</br></div>';}

if (isset($dad1_dad1_dad1_title)){
echo '<div class="laikagen3m"><a href="'.$dad1_dad1_dad1_link.'">'.$dad1_dad1_dad1_title. '</a><br/></div>';}
else{echo '<div class="laikagen3m">'.$laikaempty.'</br></div>';}
echo '</div>';
}







?>


</div>

</article>
<?php comments_template( '', true ); ?>

</div>
</div>
<?php get_footer(); ?>
