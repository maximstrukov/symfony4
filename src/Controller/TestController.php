<?php

namespace App\Controller;

use App\Service\Manual;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Task;
use App\Form\TaskType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use Psr\Log\LoggerInterface;
use App\Service\Test;
use App\Service\Cook;
use App\Service\MessageGenerator;
use App\Updates\SiteUpdateManager;

class TestController extends Controller
{
    /**
     * @Route("/test", name="test")
     */
    public function index()
    {
        return $this->render('test/index.html.twig', [
            'controller_name' => 'TestController',
        ]);
    }

    /**
     * @param Request $request
     * @Route("/newtask")
     * @Template()
     * @return array|Response
     */
    public function newTask(Request $request)
    {
        // creates a task and gives it some dummy data for this example
        $task = new Task();
        $task->setTask('Write a blog post');
        $task->setDueDate(new \DateTime('tomorrow'));

        $form = $this->createForm(TaskType::class, $task);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            //$data = $form->getData();
            $task = $form->getData();
            $terms = $form->get('agreeTerms')->getData();
            dump($terms);
            exit;
            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            // $entityManager = $this->getDoctrine()->getManager();
            // $entityManager->persist($task);
            // $entityManager->flush();

            return $this->redirectToRoute('task_success');
        }

        /*return $this->render('default/new.html.twig', array(
            'form' => $form->createView(),
        ));*/
        return ['form' => $form->createView()];
    }

    /**
     * @Route("/tasksuccess", name="task_success")
     * @Template()
     */
    public function taskSuccess(): void
    {

    }

    /**
     * @Route("/list", name="list")
     * @Template()
     */
    public function list(LoggerInterface $logger): void
    {
        $logger->info('Look! I just used a service!!!');

    }

    /**
     * @Route("/message", name="message")
     */
    public function message(MessageGenerator $messageGenerator, Test $test)
    {
        // thanks to the type-hint, the container will instantiate a
        // new MessageGenerator and pass it to you!
        // ...

        $test->trythis();

        $message = $messageGenerator->getHappyMessage();
        $this->addFlash('success', $message);
        $message2 = $messageGenerator->getCrazyMessage();


        exit("plop");
//        return new Response();
//
    }

    /**
     * @Route("/update", name="update")
     * @Template()
     * @param SiteUpdateManager $siteUpdateManager
     *
     * @return Response
     */
    public function update(SiteUpdateManager $siteUpdateManager): Response
    {
        // ...

        if ($siteUpdateManager->notifyOfSiteUpdate()) {
            dump("We sent it!");
            $this->addFlash('success', 'Notification mail was sent successfully.');
        }

        return $this->render('test/index.html.twig', [
            'controller_name' => 'TestController',
        ]);

        // ...
    }

    /**
     * @Route("/cook")
     * @param Cook   $cook
     *
     * @param Manual $manual
     *
     * @return Response
     */
    public function cook(Cook $cook, Manual $manual)
    {


        $cook->fry();

        //$manual->run();

        return $this->render('test/index.html.twig', [
            'controller_name' => 'TestController',
        ]);

    }

}
