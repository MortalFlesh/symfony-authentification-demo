<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use AppBundle\Form\Type\UserType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Symfony\Component\Security\Http\SecurityEvents;

/**
 * @Route("/test2")
 */
class Test2Controller extends Controller
{
    /**
     * @Route("/", name="app_test2_index")
     * @Template()
     *
     * @return array
     */
    public function indexAction()
    {
        return [
            'title' => 'Test2',
        ];
    }

    /**
     * @Route("/vstup/", name="app_test2_login")
     * @Template()
     *
     * @param Request $request
     * @return array
     */
    public function loginAction(Request $request)
    {
        $user = new User();

        $form = $this->createForm(UserType::class, $user)
            ->add('continue', SubmitType::class, [
                'label' => 'Pokračovat',
            ])
            ->handleRequest($request);

        if ($form->isValid()) {
            $userRepository = $this->getDoctrine()->getRepository('AppBundle:User');

            $registeredUser = $userRepository->findByEmail($user->getEmail());
            if ($registeredUser) {
                $user = $registeredUser;
            } else {
                $userRepository->saveUser($user);
            }

            $token = new UsernamePasswordToken(
                $user->getUsername(),
                $user->getPassword(),
                'test2',
                $user->getRoles()
            );

            $this->get('security.authentication.manager')->authenticate($token);
            $this->get('security.token_storage')->setToken($token);

            //return $this->redirectToRoute('app_test2_content');
        }

        return [
            'title' => 'Test2',
            'form' => $form->createView(),
        ];
    }

    /**
     * @Route("/obsah/", name="app_test2_content")
     * @Template()
     *
     * @return array
     */
    public function contentAction()
    {
        return [
            'title' => 'Test2',
        ];
    }
}
