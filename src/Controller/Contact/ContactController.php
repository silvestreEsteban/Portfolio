<?php

namespace App\Controller\Contact;

use App\Entity\Contact;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\Address;
use Symfony\Component\Routing\Attribute\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'contact')]
    public function contactMe(Request $request, MailerInterface $mailer): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $email = (new Email())
                ->from('silvestrefernandez777@gmail.com')  // Your verified sender email
                ->replyTo(new Address($contact->getEmail(), $contact->getName()))
                ->to('silvestrefernandez777@gmail.com')
                ->subject('Model Portfolio Enquiry from ' . $contact->getName())
                ->html(
                    $this->renderView(
                        'email/contact.html.twig',
                        ['contact' => $contact]
                    )
                );

            try {
                $mailer->send($email);
                $this->addFlash('success', 'Your email has been sent.');
                return $this->redirectToRoute('contact');
            } catch (\Exception|TransportExceptionInterface $exception) {
                $this->addFlash('error', 'Sorry, something went wrong. Please try again later.');
            }
        }

        return $this->render('contact/contact.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}