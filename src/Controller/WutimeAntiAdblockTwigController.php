<?php

/**
 * @file
 * Contains \Drupal\wutime_anti_adblock\Controller\AdblockTwigController.
 */
 
namespace Drupal\wutime_anti_adblock\Controller;
 
use Drupal\Core\Controller\ControllerBase;
 
class AdblockTwigController extends ControllerBase {
  public function content() {
    // Get module config
    $config = \Drupal::config('wutime_anti_adblock.settings');

    return [
      '#theme' => 'wutime_anti_adblock_overlay',
      '#wutime_anti_adblock_enable' => $config->get('wutime_anti_adblock_enable'),
      '#wutime_anti_adblock_allow_prompt_close' => $config->get('wutime_anti_adblock_allow_prompt_close'),
      '#wutime_anti_adblock_overlay_disable' => $config->get('wutime_anti_adblock_overlay_disable'),
      '#wutime_anti_adblock_prompt_delay_secs' => $config->get('wutime_anti_adblock_prompt_delay_secs'),
    ];
 
  }
}
