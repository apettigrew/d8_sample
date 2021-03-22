<?php

namespace Drupal\stripe_donation\Form;

use Symfony\Component\HttpFoundation\RedirectResponse,
    Drupal\Core\Form\FormBase,
    Drupal\Core\Form\FormStateInterface;



class StripeDonationForm extends FormBase 
{
    /**
     * Build the end-user-facing Stripe donation form.
     *
     * @param array $form
     *   Default form array structure.
     * @param FormStateInterface $form_state
     *   Object containing current form state.
     *
     * @return array
     *   The render array defining the elements of the form.
     */
    public function buildForm(array $form, FormStateInterface $form_state) {
        $form['amount'] = [
            '#id' => 'amount',
            '#type' => 'number',
            '#title' => $this->t('Donation Amount'),
        ];



        $form['actions'] = [
            '#type' => 'actions',
        ];

        $form['actions']['submit'] = [
            '#id' => 'donate',
            '#type' => 'submit',
            '#value' => $this->t('Donate'),
        ];

        return $form;
    }

    /**
     * {@inheritdoc}
     */
    public function getFormId() {
        return 'stripe_donation_form';
    }

    /**
     * {@inheritdoc}
     */
    public function submitForm(array &$form, FormStateInterface $form_state) {
        $amount = $form_state->getValue('amount');

        drupal_set_message(t('Thank you for your donation of $%amount dollars', ['%amount' => $amount]));
    }
}
