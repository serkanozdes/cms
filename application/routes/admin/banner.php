<?php
return array(
        
        'GET /admin/banner' => function  ()
        {
            $banner = new banner();
            $lang = new Language();
            $langs = $lang->getLangs();
            return View::make('layouts.admin')->nest('content', 'banner.index', 
                    array('banner' => $banner->getBannerByLang($langs[0]['id']), 
                            'langs' => $langs));
        },
        'GET /admin/banner/(:any)' => function  ($lang_id)
        {
            $banner = new banner();
            $lang = new Language();
            $langs = $lang->getLangs();
            return View::make('layouts.admin')->nest('content', 'banner.index',
                    array('banner' => $banner->getBannerByLang($lang_id),
                            'langs' => $langs));
        },
        
        'POST /admin/banner, POST /admin/banner/(:any)' => function  ($lang_id=null)
        {
            $id=$_POST['id'];
            $banner = new banner();
            $banner->updateBanner($id, $_POST);
            return Redirect::to('/admin/banner/'.$lang_id);
        }, 
        
);

