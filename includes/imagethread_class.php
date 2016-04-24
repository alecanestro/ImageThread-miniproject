<?php

class imagethread {

    private $sFileNameViews = './data/views.json';
    private $sFileNamePosts = './data/posts.json';
    private $sDirectoryPosts = './data/posts/';

    function __construct() {
        
    }

    public function countViews() {
        $sFileContent = file_get_contents($this->sFileNameViews);
        $aViews = json_decode($sFileContent, TRUE);
        $aViews['views'] ++;
        $sFileContantPut = json_encode($aViews);
        file_put_contents($this->sFileNameViews, $sFileContantPut);
        return $aViews['views'];
    }

    public function countPosts() {
        $sFileContent = file_get_contents($this->sFileNamePosts);
        $aPosts = json_decode($sFileContent, TRUE);
        return count($aPosts);
    }

    public function getPosts() {
        $sFileContent = file_get_contents($this->sFileNamePosts);
        $aPosts = json_decode($sFileContent, TRUE);
        return $aPosts;
    }

    public function nameSaveImage($sFilename) {
        $now = DateTime::createFromFormat('U.u', microtime(true));
        $iPostImageName = $now->format("YmdHisu") . rand(0, 4000);
        $sFileName = 'post' . $iPostImageName . '.' . preg_replace('/(.*)\.(jpeg|jpg|gif|png)/', '$2', $sFilename);

        return $sFileName;
    }

    public function saveDataPost($sFilename, $sTitle = '') {
        $aPosts = json_decode(file_get_contents($this->sFileNamePosts), TRUE);
        $aPosts[] = ['title' => $sTitle, 'file' => $sFilename];

        file_put_contents($this->sFileNamePosts, json_encode($aPosts));
        
        return true;
    }

}
