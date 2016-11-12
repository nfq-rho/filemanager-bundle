<?php

/**
 * This file is part of the "NFQ Bundles" package.
 *
 * (c) NFQ Technologies UAB <info@nfq.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */


namespace Nfq\FileManagerBundle\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class FileManagerController
 * @package Nfq\FileManagerBundle\Controller\Admin
 */
class FileManagerController extends Controller
{
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function uploadAction(Request $request)
    {
        $mimeTypes = [
            "image/png",
            "image/jpeg",
            "image/jpg",
            "image/gif"
        ];

        $responseParams = [];

        /** @var UploadedFile $file */
        $file = $request->files->get('userfile');

        if (in_array($file->getClientMimeType(), $mimeTypes)) {
            $filename = substr(md5(time()), 0, 8) . $file->getClientOriginalName();
            $file->move($this->get('kernel')->getRootDir() . '/../web/uploads/', $filename);


            $responseParams['result'] = 'File uploaded successfully';
            $responseParams['resultcode'] = 'ok';
            $responseParams['file_name'] = '/uploads/' . $filename;
        } else {
            $responseParams['result'] = 'File failed to upload. Incorrect type. Supported types: ' . implode(', ',
                    $mimeTypes);
            $responseParams['resultcode'] = 'failed';
            $responseParams['file_name'] = 'no_file';
        }

        return $this->render('NfqFileManagerBundle:Upload:result.html.twig', $responseParams);
    }

    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function dialogAction()
    {
        $glob = glob($this->get('kernel')->getRootDir() . '/../web/uploads/*');
        $images = [];
        foreach ($glob as $item) {
            if (is_file($item)) {
                $name = explode('/', $item);
                $images[] = end($name);
            }
        }

        return $this->render('NfqFileManagerBundle:Upload:dialog.html.twig', [
            'uploadUrl' => $this->generateUrl('nfq_filemanager_upload'),
            'images' => $images
        ]);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function deleteAction(Request $request)
    {
        $responseData = ['status' => true];
        if (!unlink($this->get('kernel')->getRootDir() . '/../web/uploads/' . basename($request->request->get('data')))) {
            $responseData['status'] = false;
        }

        return new JsonResponse($responseData);
    }
}
