<?php  // nos garantiza una única llamada al objeto
require_once ("DataSource.php");
class SingletonDataSource{

    private static $data;


    public function getDataInstance()
    {
		
        if(!isset($data) || $data == NULL)
        {
            $data = new DataSource();
			
        }
        return $data;
    }
}
?>