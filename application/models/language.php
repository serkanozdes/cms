<?php

class Language
{

    function getLangs ()
    {
        $result = R::getAll('select * from languages');
        return $result;
    }

    function getLang ($id)
    {
        $result = R::getRow('select * from languages where id=?', array($id));
        return $result;
    }

    function addLang ($data)
    {
        $lang = R::dispense('languages');
        foreach ($data as $key => $val) {
            $lang->$key = $val;
        }
        $id=R::store($lang);
        
        $banner=new Banner();
        $banner->addBanner(array(
                'top_banner'=>'',
                
                'banner1_frame1'=>'',
                'banner1_frame2'=>'',
                'banner1_frame3'=>'',
                'banner1_frame4'=>'',
                'banner1_footer'=>'',
                
                'banner2_frame1'=>'',
                'banner2_frame2'=>'',
                'banner2_frame3'=>'',
                'banner2_frame4'=>'',
                'banner2_footer'=>'',
                
                'banner3_frame1'=>'',
                'banner3_frame2'=>'',
                'banner3_frame3'=>'',
                'banner3_frame4'=>'',
                'banner3_footer'=>'',
                
                'banner4_frame1'=>'',
                'banner4_frame2'=>'',
                'banner4_frame3'=>'',
                'banner4_frame4'=>'',
                'banner4_footer'=>'',
                
                'lang_id'=>$id
        ));
    }

    function updateLang ($id, $data)
    {
        $lang = R::load('languages', $id);
        foreach ($data as $key => $val) {
            $lang->$key = $val;
        }
        R::store($lang);
    }

    function deleteLang ($id)
    {
        R::exec('delete from banners where lang_id=?',array($id));   
        $lang = R::load('languages', $id);
        R::trash($lang);
    }
}

?>