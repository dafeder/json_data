<?php

declare(strict_types=1);

namespace Drupal\json_data;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;

/**
 * Defines the access control handler for the json data entity type.
 *
 * phpcs:disable Drupal.Arrays.Array.LongLineDeclaration
 *
 * @see https://www.drupal.org/project/coder/issues/3185082
 */
final class JsonDataAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  protected function checkAccess(EntityInterface $entity, $operation, AccountInterface $account): AccessResult {
    if ($account->hasPermission($this->entityType->getAdminPermission())) {
      return AccessResult::allowed()->cachePerPermissions();
    }

    return match($operation) {
      'view' => AccessResult::allowedIfHasPermission($account, 'view json_data'),
      'update' => AccessResult::allowedIfHasPermission($account, 'edit json_data'),
      'delete' => AccessResult::allowedIfHasPermission($account, 'delete json_data'),
      'delete revision' => AccessResult::allowedIfHasPermission($account, 'delete json_data revision'),
      'view all revisions', 'view revision' => AccessResult::allowedIfHasPermissions($account, ['view json_data revision', 'view json_data']),
      'revert' => AccessResult::allowedIfHasPermissions($account, ['revert json_data revision', 'edit json_data']),
      default => AccessResult::neutral(),
    };
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL): AccessResult {
    return AccessResult::allowedIfHasPermissions($account, ['create json_data', 'administer json_data'], 'OR');
  }

}
