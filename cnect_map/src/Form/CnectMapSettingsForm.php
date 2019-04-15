<?php

namespace Drupal\cnect_map\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Class CnectMapSettingsForm.
 * @package Drupal\cnect_map\Form
 * @ingroup cnect_map
 */
class CnectMapSettingsForm extends FormBase {

  /**
   * Returns a unique string identifying the form.
   *
   * @return string
   *   The unique string identifying the form.
   */
  public function getFormId() {
    return 'cnect_map_settings';
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Empty implementation of the abstract submit class.
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['cnect_map_settings']['#markup'] = 'Settings form for CnectMapEntityExample. Manage field settings here.';
    return $form;
  }

}
