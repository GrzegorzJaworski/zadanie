<?php

namespace AppBundle\Controller;

use AppBundle\Form\WebsitesType;
use AppBundle\Service\PageAlert;
use AppBundle\Service\PageSpeed;
use AppBundle\Service\ReportFile;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @param Request $request
     * @param PageSpeed $pageSpeed
     * @param PageAlert $pageAlert
     * @param ReportFile $reportFile
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction(Request $request, PageSpeed $pageSpeed, PageAlert $pageAlert, ReportFile $reportFile)
    {

        $form = $this->createForm(WebsitesType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $data = $form->getData();

            $report = [];

            $report[] = [
                'url' => $data['main'],
                'time' => $pageSpeed->getLoadTime($data['main']),
            ];

            foreach($data['urls'] as $url) {
                $report[] = [
                    'url' => $url,
                    'time' => $pageSpeed->getLoadTime($url),
                ];
            }

            $pageAlert->checkIfAlert($report);

            $reportFile->saveTxt($report);

            $this->addFlash('success', 'Raport utworzony');
        }


        return $this->render('default/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
