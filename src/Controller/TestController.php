<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends Controller
{
    /**
     * @Route("/", name="test")
     *
     * @param Request $request
     *
     * @return Response
     */
    public function index(Request $request)
    {
        $form = $this->createFormBuilder()
            ->add('file', FileType::class, ['label' => 'Select file'])
            ->add('save', SubmitType::class, ['label' => 'Guess file extension'])
            ->getForm();

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            /** @var UploadedFile $uploadedFile */
            $uploadedFile = $data['file'];

            dump($uploadedFile->guessClientExtension());
            dump('xlsm is expected');
            dump($uploadedFile->getClientMimeType());
            die;
        }

        return $this->render('index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
