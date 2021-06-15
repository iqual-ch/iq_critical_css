<?php

namespace Drupal\iq_critical_css\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Configuration form for critical css.
 */
class SettingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'iq_critical_css_settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames() {
    return ['iq_critical_css.settings'];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $config = $this->config('iq_critical_css.settings');

    $form['critical_css_files'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Critical CSS Files (Global)'),
      '#description' => $this->t('CSS files to be included in page head. One per row'),
      '#default_value' => $config->get('critical_css_files'),
    ];

    $form['critical_css_code'] = [
      '#type' => 'textarea',
      '#title' => $this->t('Critical CSS Code (Global)'),
      '#description' => $this->t('Additional CSS Code to be included in page head.'),
      '#default_value' => $config->get('critical_css_code'),
    ];

    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    $config = $this->config('iq_critical_css.settings');
    $config
      ->set('critical_css_files', $form_state->getValue('critical_css_files'))
      ->set('critical_css_code', $form_state->getValue('critical_css_code'))
      ->save();

    parent::submitForm($form, $form_state);
  }

}
