<?php

namespace Drupal\cnect_map\Form;

use Drupal\Core\Entity\ContentEntityForm;
use Drupal\Core\Language\Language;
use Drupal\Core\Form\FormStateInterface;

/**
 * Form controller for the cnect_map entity edit forms.
 *
 * @ingroup cnect_map
 */
class CnectMapForm extends ContentEntityForm {

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {

    $entity = $this->entity;

    /** Custom Field.
     *
     * $entity = $this->entity;
     * $val = $entity->get('description')->getValue()[0]['value'];
     *
     * $val conterrà ad esempio l'oggetto json da essere spacchettato,
     * editato, ri-pacchettizzato e salvato.
     *
     *
      $form['pippo'] = [
        '#type' => 'textfield',
        '#title' => t("I accept the website's terms."),
        '#required' => TRUE,
        '#value' => $val,
      ];
     */

    $a = $entity->get('title')->getValue()[0]['value'];
    $b = $entity->get('name')->getValue()[0]['value'];
    $my_array = [
      'a' => $a,
      'b' => $b
    ];
    $encoded = json_encode($my_array);
    $entity->get('settings')->setValue($encoded);

    /* @var $entity \Drupal\cnect_map\Entity\CnectMap */
    $form = parent::buildForm($form, $form_state);

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function save(array $form, FormStateInterface $form_state) {
    $form_state->setRedirect('entity.cnect_map.collection');
    $entity = $this->getEntity();
    $entity->save();
  }

}
