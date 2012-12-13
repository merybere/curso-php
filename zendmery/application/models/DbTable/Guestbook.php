<?php

class Application_Model_DbTable_Guestbook extends Zend_Db_Table_Abstract
{
    // Toda la tabla se convierte en un objeto con la clase Zend_Db_Table_Abstract
    protected $_name = 'guestbook';
}
