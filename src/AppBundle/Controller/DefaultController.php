<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /** @var  User */
    private $user;

    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {
        $this->initUser();
        $handler = $this->get('frontend.form_handlers.user')->setModel($this->user);

        return $this->render('default/index.html.twig', array(
            'form' => $handler->getBuiltFormView(),
            'user' => $this->user,
        ));
    }

    /**
    * @Route("/user", name="user")
    */
    public function userAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('AppBundle:User')
            ->findOneBy(['id'=>1]);

        $responseObject =  (object) [
            'userName' => $user->getUserName(),
            'userBirthday' => $user->getUserBirthdayInputFormatted(),
            'userEmail' => $user->getUserEmail(),
            'siteUrl' => $user->getSiteUrl(),
            'userPhone' => $user->getUserPhone(),
            'userSkill' => $user->getUserSkill(),
            'userGender' => $user->getUserGender(),
            'userAbout' => $user->getUserAbout()
        ];

        $jsonContent = json_encode($responseObject);

        $response = new Response(json_encode(array(
            $jsonContent
        )));

        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * @Route("/update", name="update")
     */
    public function updateAction()
    {
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('AppBundle:User')
            ->findOneBy(['id'=>1]);
        $data = $_POST = json_decode(file_get_contents('php://input'), true);

        if($data){
            $user->setUserName($data['userName']);
            $user->setUserBirthday($data['userBirthday']);
            $user->setUserEmail($data['userEmail']);
            $user->setSiteUrl($data['siteUrl']);
            $user->setUserPhone($data['userPhone']);
            $user->setUserSkill($data['userSkill']);
            $user->setUserGender($data['userGender']);
            $user->setUserAbout($data['userAbout']);
            if(isset($data['userPwd']) && isset($data['userRpwd']) && $data['userPwd'] != null && $data['userRpwd'] != null
            && !empty($data['userPwd']) && !empty($data['userRpwd']) && $data['userPwd'] === $data['userRpwd'])
                $user->setPassword($data['userPwd']);

            $em->persist($user);
            $em->flush();
        }

        $response = new Response(json_encode(
            'saved'
        ));

        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

    /**
     * Inits current user
     */
    private function initUser()
    {
        $userRepo = $this->get('doctrine')->getRepository('AppBundle:User');
        $user = $userRepo->findOneBy(array('idToken' => '5dsf4dsf5sdf4'));
        if (!$user instanceof User) {
            throw $this->createNotFoundException('User not found, please load fixtures');
        }

        $this->user = $user;
    }
}
