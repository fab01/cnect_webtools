<?php

namespace Drupal\cnect_map;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\user\EntityOwnerInterface;
use Drupal\Core\Entity\EntityChangedInterface;

/**
 * Provides an interface defining a Map entity.
 *
 * We have this interface so we can join the other interfaces it extends.
 *
 * @ingroup cnect_map
 */
interface CnectMapInterface extends ContentEntityInterface, EntityOwnerInterface, EntityChangedInterface {

}
