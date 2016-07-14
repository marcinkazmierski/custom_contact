<?php
namespace Drupal\custom_contact\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Block\BlockPluginInterface;
use Drupal\Core\Form\FormStateInterface;


/**
 * Provides a 'Custom contact' Block
 *
 * @Block(
 *   id = "custom_contact_block",
 *   admin_label = @Translation("Custom contact block"),
 * )
 */
class CustomContactBlock extends BlockBase implements BlockPluginInterface
{
    /**
     * {@inheritdoc}
     */
    public function build()
    {
        $config = $this->getConfiguration();

        if (!empty($config['name'])) {
            $name = $config['name'];
        } else {
            $name = $this->t('to no one');
        }
        $form = \Drupal::formBuilder()->getForm('Drupal\custom_contact\Form\DemoForm');
        kint($form);


        return $form;
        return array(
            '#markup' => $this->t('Hello @name!', array(
                    '@name' => $name,
                )
            ),
        );
    }

    /**
     * {@inheritdoc}
     */
    public function blockForm($form, FormStateInterface $form_state)
    {
        $form = parent::blockForm($form, $form_state);

        $config = $this->getConfiguration();

        $form['contact_block_name'] = array(
            '#type' => 'textfield',
            '#title' => $this->t('Who'),
            '#description' => $this->t('Who do you want to say hello to?'),
            '#default_value' => isset($config['name']) ? $config['name'] : ''
        );

        return $form;
    }

    /**
     * {@inheritdoc}
     */
    public function blockSubmit($form, FormStateInterface $form_state)
    {
        $this->setConfigurationValue('name', $form_state->getValue('contact_block_name'));
    }

    /**
     * {@inheritdoc}
     */
    public function blockValidate($form, FormStateInterface $form_state)
    {
        $name = $form_state->getValue('contact_block_name');
        if (empty($name)) {
            $form_state->setErrorByName('contact_block_name', t('Not empty, please!'));
        }
    }
}