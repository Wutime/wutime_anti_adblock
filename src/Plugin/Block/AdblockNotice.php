<?php

namespace Drupal\wutime_anti_adblock\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'AdblockNotice' Block.
 *
 * @Block(
 *   id = "AdBlock Detection Notice",
 *   admin_label = @Translation("AdBlock Detection"),
 *   category = @Translation("AdBlock Detection"),
 *   region = @Translation("Highlighted"),
 * )
 */
class AdblockNotice extends BlockBase {


  /**
   * {@inheritdoc}
   *
  public function build() {
    $default_config = \Drupal::config('wutime_anti_adblock.settings');

    return array(
        '#title' => $default_config->get('title'),
        '#theme' => 'wutime_anti_adblock',
        '#markup' => $this->t('Sure!!!, ad-blocking software does a great job at blocking ads, but it also blocks some useful and important features of our website. For the best possible site experience please take a moment to disable your AdBlocker.'),
        '#attributes' => array('class' => 'wu_testing', 'style' => 'display:none;'),
        '#attached' => ['library' => ['wutime_anti_adblock/wutime_anti_adblock']],
    );
  }

  /**
   * {@inheritdoc}
   *
  public function defaultConfiguration() {
    $default_config = \Drupal::config('wutime_anti_adblock.settings');
    return [
      'wutime_anti_adblock_block_name' => $default_config->get('title'),
      'wutime_anti_adblock_admin_label' => $default_config->get('title')
    ];
  }
*/
}
