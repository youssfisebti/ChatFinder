<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use FOS\RestBundle\Context\Context;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Nelmio\ApiDocBundle\Annotation\Model;
use Swagger\Annotations as SWG;
use FOS\RestBundle\Controller\AbstractFOSRestController;
use FOS\RestBundle\Request\ParamFetcher;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use App\Service\ErrorService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
use App\ValueObject\DefaultParameters;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Doctrine\DBAL\Exception\UniqueConstraintViolationException;


class UserManagementController extends AbstractFOSRestController
{
    /**
     * @Rest\Get("/users", name="api_users_list")
     *
     * @SWG\Response(
     *     response=200,
     *     description="Return list of users",
     *     @SWG\Items(ref=@Model(type=User::class, groups={"user_profil"}))
     * ),
     * @SWG\Response(
     *     response=403,
     *     description="Forbidden",
     *     examples={
     *          "invalid username/password":{
     *              "message": "Invalid credentials."
     *          },
     *          "Invalid customer ref/scope":{
     *              "message": "Access Denied"
     *          },
     *     }
     * ),
     * @SWG\Response(
     *     response=404,
     *     description="Not Found error",
     * ),
     * @SWG\Response(
     *     response=500,
     *     description="Technical error",
     * ),
     * @Rest\QueryParam(name="criteria", strict=false,   nullable=false)
     * @Rest\QueryParam(name="limit", strict=false,  nullable=true)
     * @Rest\QueryParam(name="offset", strict=false, nullable=true)
     * @SWG\Tag(name="User")
     * @param ParamFetcher $paramFetcher
     * @param UserRepository $repo
     * @return \FOS\RestBundle\View\View
     * @throws \Exception
     */
    public function listUsers(paramFetcher $paramFetcher, UserRepository $repo)
    {
        $responseCode = Response::HTTP_OK;
        $context = new Context();
        $groups = ['user_profil'];
        $context->setGroups($groups);
        $limit = $paramFetcher->get('limit') ?? $this->getParameter('defaultLimit');
        $offset = $paramFetcher->get('offset') ?? $this->getParameter('defaultOffset');
        $users = $repo->findBySomeField($paramFetcher->get('criteria'), $limit, $offset);
             
     //   $pharmacy = $->list($paramFetcher->get('criteria') , $limit, $offset, $pharmacyRepository);
        $response = [
            "totalItems" => count($users),
            "items" => $users
        ];

        $view = $this->view($response, $responseCode);
        $view->setContext($context);
        return $view;
    }

  /**
     * @Rest\Post("/user/register", name="api_register_user")
     * @Rest\QueryParam(name="email", strict=false,   nullable=false)
     * @Rest\QueryParam(name="password", strict=false,  nullable=true)
     * @Rest\QueryParam(name="password_confirmation", strict=false, nullable=true)
     */
    public function register(paramFetcher $paramFetcher, UserPasswordEncoderInterface $passwordEncoder, EntityManagerInterface $om)
    {
        $context = new Context();
        $groups = ['user_profil'];
        $responseCode = Response::HTTP_OK;
        $response = [
            "totalItems" => 1,
            "items" => 10
        ];

        $email= $paramFetcher->get('email') ?? $this->getParameter('email');
        $password = $paramFetcher->get('password') ?? $this->getParameter('password');
        $passwordConfirmation= $paramFetcher->get('password_confirmation') ?? $this->getParameter('password_confirmation');

        $errors = [];
        $user = new User();
        if($password != $passwordConfirmation)
        {
             $errors[] = "Password does not match the password confirmation.";
        }
        if(strlen($password) < 6)
        {
           $errors[] = "Password should be at least 6 characters.";
        }

        if(!$errors)
        {
           $encodedPassword = $passwordEncoder->encodePassword($user, $password);
           $user->setEmail($email);
           $user->setPassword($encodedPassword);

         try
         {
            $om->persist($user);
            $om->flush();
            return $this->json([
                'user' => $user
            ]);
         }
         catch(UniqueConstraintViolationException $e)
         {
            $errors[] = "The email provided already has an account!";
         }
         catch(\Exception $e)
         {
            $errors[] = "Unable to save new user at this time.";
         }

          return $this->json([
              'errors' => $errors
          ], 400);
    }
}
}
