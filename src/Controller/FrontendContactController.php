<?php

namespace App\Controller;

use App\Form\Type\PostalAdressType;
use App\Form\Type\RecaptchaType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class FrontendContactController extends AbstractController
{
    /**
     * @Route("/contacter-madatsara.html", name="frontend_contact")
     */
    // http://madatsara.localhost/contacter-madatsara.html
    public function index(Request $request)
    {
        $form = $this->createFormBuilder()
            ->add('Name', null, [
                // Todo - Translate
                'label' => 'Votre nom : ',
                'constraints' => [
                    new NotBlank(),
                    new Length(['min' => 3]),
                ],
            ])
            ->add('Email', EmailType::class, [
                // Todo - Translate
                'label' => 'Votre email : ',
                'constraints' => [
                    new NotBlank(),
                    new Length([
                        'min' => 2
                    ]),
                ],
            ])
            ->add('Message', TextareaType::class, [
                // Todo - Translate
                'label' => 'Votre message : ',
                'constraints' => [
                    new NotBlank(),
                    new Length([
                        'min' => 2,
                        // Todo - Translate
                        'minMessage' => 'Value too short. It should have {{ limit }} character or more.|Value too short. It should have {{ limit }} characters or more.'
                    ]),
                ],
            ])
            ->add('NewsletterSubscribe', CheckboxType::class, [
                // Todo - Translate
                'label' => 'Souscrire à notre newsletter',
                'required' => false
            ])
            // Todo - add recaptcha bundle
            ->add('Save', SubmitType::class,[
                // Todo - Translate
                'label' => 'Envoyer'
            ])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // Todo - send email confirm

            // Todo - Send mail admin

            // Todo - if newsletterSubscribe - persistsDB

            // Create flash message
            $this->addFlash('notice', 'frontend.contact.success_message');

            // Todo - Redirect to route "frontend_contact"
            return $this->redirectToRoute("frontend_contact");
        }

        return $this->render('frontend/contact/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
