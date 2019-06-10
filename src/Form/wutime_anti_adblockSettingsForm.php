<?php

namespace Drupal\wutime_anti_adblock\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Configure example settings for this site.
 */
class wutime_anti_adblockSettingsForm extends ConfigFormBase {
    /** @var string Config settings */
  const SETTINGS = 'wutime_anti_adblock.settings';

  /** 
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'wutime_anti_adblock_admin_settings';
  }

  /** 
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return [
      static::SETTINGS,
    ];
  }

  /** 
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config(static::SETTINGS);


    $form['enable'] = array(
      '#type' => 'fieldset',
      '#title' => t('Enable'),
      '#collapsible' => FALSE,
      '#collapsed' => FALSE,  
    );

    $form['enable']['wutime_anti_adblock_enable'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Enable AdBlock detection'),
      '#description' => $this->t('If disabled, AdBlock detection 
        will be disabled'),
      '#default_value' => $config->get('wutime_anti_adblock_enable'),
    ]; 

    $form['enable']['wutime_anti_adblock_ignore_admin_pages'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Ignore admin pages'),
      '#description' => $this->t('If enabled, AdBlock detection 
        will never be shown on admin pages'),
      '#default_value' => $config->get('wutime_anti_adblock_ignore_admin_pages'),
    ]; 

    $form['overlay'] = array(
      '#type' => 'fieldset',
      '#title' => t('Overlay'),
      '#collapsible' => FALSE,
      '#collapsed' => FALSE,  
    );


    $form['overlay']['wutime_anti_adblock_theme'] = [
      '#type' => 'select',
      '#options' => [
        'default' => t('Default'),
        'light' => t('Light'),
        'dark' => t('Dark')],
      '#title' => $this->t('Overlay theme'),
      '#description' => $this->t('This theme only applies 
        to the popup overlay.'),
      '#default_value' => $config->get('wutime_anti_adblock_theme'),
    ]; 

    $form['overlay']['wutime_anti_adblock_prompt_delay_secs'] = [
      '#type' => 'number',
      '#min' => 1,
      '#max' => 100,
      '#title' => $this->t('AdBlock detection overlay delay in seconds'),
      '#description' => '<div>'.$this->t('How many seconds do you want to 
        wait for the AdBlock detection overlay to appear?').'</div><div>'.
      $this->t('This setting only applies if you have the AdBlock 
        detection overlay enabled').'</div>',
      '#default_value' => $config->get('wutime_anti_adblock_prompt_delay_secs'),
    ]; 

    $form['overlay']['wutime_anti_adblock_allow_prompt_close'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Allow user to close the AdBlock detection overlay'),
      '#description' => '<div>'.$this->t('This setting only applies if you 
        have the Adblock detection overlay enabled').'</div>',
      '#default_value' => 
        $config->get('wutime_anti_adblock_allow_prompt_close'),
    ]; 

    $form['notice'] = array(
      '#type' => 'fieldset',
      '#title' => t('Disable Overlay'),
      '#collapsible' => FALSE,
      '#collapsed' => FALSE,  
    );

    $form['notice']['wutime_anti_adblock_overlay_disable'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Disable the overlay and show a notice instead'),
      '#description' => '<div>'.$this->t('<b>YOU MUST</b> have an active AdBlock 
            Detection Block on your: '). 
          \Drupal::l(t('Block layout'), 
            \Drupal\Core\Url::fromUri('internal:/admin/structure/block')).
                          '</div>',
      '#default_value' => $config->get('wutime_anti_adblock_overlay_disable'),
    ]; 

    $form['testing'] = array(
      '#type' => 'fieldset',
      '#title' => t('Testing mode'),
      '#collapsible' => FALSE,
      '#collapsed' => FALSE,  
    );

    $form['testing']['wutime_anti_adblock_ignore_perms'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Ignore permissions and show AdBlock to everyone'),
      '#description' => '<div>'.$this->t('If enabled, AdBlock detection usergroup 
        permissions will be ignored and adblock will show to everyone, 
        including administrators.').
        '</div><div>AdBlock bypass permissions can be found here: '.
        \Drupal::l(t('Permissions'), 
        \Drupal\Core\Url::fromUri('internal:/admin/people/permissions')).
                          '</div>',
      '#default_value' => $config->get('wutime_anti_adblock_ignore_perms'),
    ]; 

    return parent::buildForm($form, $form_state);
  }

  /** 
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {

    drupal_flush_all_caches();
    
    $this->configFactory->getEditable(static::SETTINGS)
      ->set('wutime_anti_adblock_enable', 
        $form_state->getValue('wutime_anti_adblock_enable'))
      ->set('wutime_anti_adblock_allow_prompt_close', 
        $form_state->getValue('wutime_anti_adblock_allow_prompt_close'))
      ->set('wutime_anti_adblock_overlay_disable', 
        $form_state->getValue('wutime_anti_adblock_overlay_disable'))
      ->set('wutime_anti_adblock_prompt_delay_secs', 
        $form_state->getValue('wutime_anti_adblock_prompt_delay_secs'))
      ->set('wutime_anti_adblock_ignore_admin_pages', 
        $form_state->getValue('wutime_anti_adblock_ignore_admin_pages'))
      ->set('wutime_anti_adblock_ignore_perms', 
        $form_state->getValue('wutime_anti_adblock_ignore_perms'))
      ->set('wutime_anti_adblock_theme', 
        $form_state->getValue('wutime_anti_adblock_theme'))
      ->save();
    parent::submitForm($form, $form_state);
  }
}
