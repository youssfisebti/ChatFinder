<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use App\Manager\UserManager;
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



class UserController extends AbstractFOSRestController
{
         /**
     * @var PharmacyManager
     */
    protected $userManager;

    /**
     * UserController constructor.
     * @param UserManager $um
     */
    public function __construct(UserManager $um)
    {
        $this->userManager = $um;

    }
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
     * @param UserRepository $userRepository
     * @return \FOS\RestBundle\View\View
     * @throws \Exception
     */
    public function listUsers()
    {
        $responseCode = Response::HTTP_OK;
        $context = new Context();
        $groups = ['user_profil'];
        $context->setGroups($groups);
       // $limit = $paramFetcher->get('limit') ?? $this->getParameter('defaultLimit');
        //$offset = $paramFetcher->get('offset') ?? $this->getParameter('defaultOffset');
     /*   $users = $this->getDoctrine()->getRepository(User::Class)->findAll();
        
     //   dump($users);
       // die;
     //   $pharmacy = $->list($paramFetcher->get('criteria') , $limit, $offset, $pharmacyRepository);
        $response = [
            "totalItems" => count($users),
            "items" => $users
        ];

        $view = $this->view($response, $responseCode);
        $view->setContext($context);
      * 
      */
         $view = $this->view("ok", $responseCode);
        return $view;
    }
    
}
