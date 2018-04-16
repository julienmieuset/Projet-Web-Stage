<?php 

SessionHandlerInterface {
	abstract public bool close ( void )
	abstract public bool destroy ( string $session_id )
	abstract public int gc ( int $maxlifetime )
	abstract public bool open ( string $save_path , string $session_name )
	abstract public string read ( string $session_id )
	abstract public bool write ( string $session_id , string $session_data )
}

?>