<?php
namespace Drupal\custom_contact\Controller;

class CustomContactController{
    public function page() {
        return array(
            '#title' => 'Contact page!',
            '#markup' => 'Here is some content.',
        );
    }
}