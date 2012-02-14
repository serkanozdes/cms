<?php

class Banner
{

    function getBanners ()
    {
        $result = R::getAll('select * from banners');
        return $result;
    }

    function getBanner ($id)
    {
        $result = R::getRow('select * from banners where id=?', array($id));
        foreach($result as $key=>$value)
        {
            $result->$key=htmlspecialchars($value);
        }
        return $result;
    }

    function getBannerByLang ($id)
    {
        $result = R::getRow('select * from banners where lang_id=?', array($id));
        foreach($result as $key=>$value)
        {
            $result[$key]=htmlspecialchars($value);
        }
        return $result;
    }

    function addBanner ($data)
    {
        $banner = R::dispense('banners');
        foreach ($data as $key => $val) {
            $banner->$key = $val;
        }
        R::store($banner);
    }

    function updateBanner ($id, $data)
    {
        $banner = R::load('banners', $id);
        foreach ($data as $key => $val) {
            $banner->$key = $val;
        }
        R::store($banner);
    }

    function deleteBanner ($id)
    {
        $banner = R::load('banners', $id);
        R::trash($banner);
    }
}