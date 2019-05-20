<?php

/**
 * @file
 * Contains cnect_map_entity.page.inc.
 *
 * Page callback for Map entity entities.
 */

use Drupal\Core\Render\Element;

/**
 * Prepares variables for Map entity templates.
 *
 * Default template: cnect_map_entity.html.twig.
 *
 * @param array $variables
 *   An associative array containing:
 *   - elements: An associative array containing the user information and any
 *   - attributes: HTML attributes for the containing element.
 */
function template_preprocess_cnect_map(array &$variables) {
  // Fetch BookEntity Entity Object.
  $cnect_map_entity = $variables['elements']['#cnect_map_entity'];

  // Helpful $content variable for templates.
  foreach (Element::children($variables['elements']) as $key) {
    $variables['content'][$key] = $variables['elements'][$key];
  }
}
