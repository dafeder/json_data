<?php

declare(strict_types=1);

namespace Drupal\json_data;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\EntityChangedInterface;
use Drupal\user\EntityOwnerInterface;

/**
 * Provides an interface defining a json data entity type.
 */
interface JsonDataInterface extends ContentEntityInterface, EntityOwnerInterface, EntityChangedInterface {

}
