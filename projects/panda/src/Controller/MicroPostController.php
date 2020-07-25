<?php

namespace App\Controller;

use App\Entity\MicroPost;
use App\Entity\User;
use App\Form\MicroPostType;
use App\Repository\MicroPostRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Flash\FlashBagInterface;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/micro-post")
 */
class MicroPostController extends AbstractController
{
    /**
     * @var MicroPostRepository
     */
    private $microPostRepository;

    /**
     * @var FormFactoryInterface
     */
    private $formFactory;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var FlashBagInterface
     */
    private $flashBag;


    public function __construct(
        MicroPostRepository $microPostRepository,
        FormFactoryInterface $formFactory,
        EntityManagerInterface $entityManager,
        FlashBagInterface $flashBag
    ) {
        $this->microPostRepository = $microPostRepository;
        $this->formFactory = $formFactory;
        $this->entityManager = $entityManager;
        $this->flashBag = $flashBag;
    }

    /**
     * @Route("/", name="micro_post_index")
     */
    public function index(UserRepository $userRepository)
    {
        $currentUser = $this->getUser();

        $usersToFollow = [];

        if ($currentUser instanceof User) {
            $posts = $this->microPostRepository->findAllByUsers($currentUser->getFollowing());

            $usersToFollow = count($posts) === 0 ?
                $userRepository->findAllWithMoreThan5PostsExceptUser($currentUser) : [];
        } else {
            $posts = $this->microPostRepository->findBy(
                [],
                ['time' => 'DESC']
            );
        }

        return $this->render(
            'micro-post/index.html.twig',
            [
                'posts' => $posts,
                'usersToFollow' => $usersToFollow
            ]
        );
    }

    /**
     * @Route("/edit/{id}", name="micro_post_edit")
     */
    public function edit(MicroPost $microPost, Request $request)
    {
        $this->denyAccessUnlessGranted('edit', $microPost);
        $form = $this->formFactory->create(MicroPostType::class, $microPost);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->flush();

            return $this->redirectToRoute('micro_post_index');
        }

        return $this->render(
            'micro-post/add.html.twig',
            [
                'form' => $form->createView()
            ]
        );
    }

    /**
     * @Route("/delete/{id}", name="micro_post_delete")
     */
    public function delete(MicroPost $microPost)
    {
        $this->denyAccessUnlessGranted('delete', $microPost);
        $this->entityManager->remove($microPost);
        $this->entityManager->flush();

        $this->flashBag->add('notice', 'Micro post was deleted');

        return $this->redirectToRoute('micro_post_index');
    }

    /**
     * @Route("/user/{username}", name="micro_post_user")
     */
    public function userPosts(User $userWithPosts)
    {
        return $this->render(
            'micro-post/user-posts.html.twig',
            [
                'posts' => $this->microPostRepository->findBy(
                    ['user' => $userWithPosts],
                    ['time' => 'DESC']
                ),
                'user' => $userWithPosts,
            ]
        );
    }

    /**
     * @Route("/add", name="micro_post_add")
     * @IsGranted("ROLE_USER")
     */
    public function add(Request $request)
    {
        $user = $this->getUser();
        $microPost = new MicroPost();
        $microPost->setUser($user);

        $form = $this->formFactory->create(MicroPostType::class, $microPost);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->entityManager->persist($microPost);
            $this->entityManager->flush();

            return $this->redirectToRoute('micro_post_index');
        }

        return $this->render(
            'micro-post/add.html.twig',
            [
                'form' => $form->createView()
            ]
        );
    }

    /**
     * @Route("/{id}", name="micro_post_post")
     */
    public function post(MicroPost $post)
    {
        return $this->render(
            'micro-post/post.html.twig',
            [
                'post' => $post
            ]
        );
    }
}
