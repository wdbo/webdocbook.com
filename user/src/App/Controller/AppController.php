<?php


namespace App\Controller;

use \WebDocBook\Kernel;
use \WebDocBook\Helper;
use \WebDocBook\Controller\DefaultController;

class AppController
    extends DefaultController
{

    public function indexAction($path)
    {
        $base_path = Kernel::getPath('web');
        if (!empty($path) && $path!=='/' && $path!==$base_path) {
            if (@is_dir($path)) {
                return $this->directoryAction($path);
            } else {
                return $this->fileAction($path);
            }
        } else {
            return $this->homepage();
        }
    }

    public function homepage()
    {
        $title          = 'Home';
        $path           = Kernel::getPath('user_templates') . 'HOMEPAGE.md';
        $page_infos     = array(
            'name'          => $title,
            'path'          => 'home',
            'update'        => Helper::getDateTimeFromTimestamp(filemtime($path))
        );
        $tpl_params     = array(
            'breadcrumbs'   => null,
            'title'         => $title,
            'page'          => $page_infos,
            'page_tools'    => 'false'
        );
        $file_content   = file_get_contents($path);
        $md_parser      = $this->wdb->getMarkdownParser();
        $md_content     = $md_parser->transformString($file_content);
        $output_bag     = $md_parser->get('OutputFormatBag');
        $content        = $this->wdb->display(
            $md_content->getBody(),
            'content',
            array(
                'page'          => $page_infos,
                'page_tools'    => 'false',
                'page_title'    => 'false',
                'page_notes'    => $md_content->getNotesToString(),
            )
        );

        return array('homepage', $content, $tpl_params);
    }

}
