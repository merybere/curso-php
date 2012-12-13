<?php

class Application_Model_Album
{
    public function getAlbums()
    {
        $table = new Application_Model_DbTable_Albums();
        $select = $table->fetchAll();
        
        $albums = $select->toArray();
        
        return $albums;
    }
}
