<?php

/**
 * Add custom Breadcrumb NavXT template tag
 */
function custom_bcn_template_tag($replacements, $type, $id)
{
  if (in_array('post-products', $type)) {
    $short_title = get_field('short_title', $id);
    $replacements['%short_title%'] = ($short_title) ? $short_title : $replacements['%htitle%'];
  } else {
    $replacements['%short_title%'] = $replacements['%htitle%'];
  }
  return $replacements;
}
add_filter('bcn_template_tags', 'custom_bcn_template_tag', 3, 10);