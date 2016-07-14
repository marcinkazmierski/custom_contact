<?php

namespace Drupal\custom_contact\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class DemoForm extends FormBase
{

    /**
     * {@inheritdoc}.
     */
    public function getFormId()
    {
        return 'demo_form';
    }

    /**
     * {@inheritdoc}.
     */
    public function buildForm(array $form, FormStateInterface $form_state)
    {

        $form['email'] = array(
            '#type' => 'email',
            '#required' => TRUE,
            '#title' => $this->t('Your email address.')
        );
        $form['submit'] = array(
            '#type' => 'submit',
            '#value' => $this->t('Submit'),
        );

        return $form;
    }

    /**
     * {@inheritdoc}
     */
    public function validateForm(array &$form, FormStateInterface $form_state)
    {
        $email = $form_state->getValue('email');

        if ($email === 'test@test.pl') {
            $form_state->setErrorByName('email',
                $this->t("The email can not be: '%email'!", array('%email' => $form_state->getValue('email'))));
        }
    }

    /**
     * {@inheritdoc}
     */
    public function submitForm(array &$form, FormStateInterface $form_state)
    {
        foreach ($form_state->getValues() as $key => $value) {
            drupal_set_message($key . ': ' . $value);
        }
    }
}