<?php

namespace App\Classes;

class Utility
{
	public static function errorMessage( $e ) {


		if( !empty( $e->errorInfo[1] ) ) {

			switch ( $e->errorInfo[1] ) {

				case 1062:
					$message = 'Registre duplicat';
					break;
				case 1451:
					$message = 'Registre amb elements relacionats';
					break;
				default:
					$message = $e->errorInfo[1].' - '.$e->errorInfo[2];
					break;

			}

		} else {

			switch ( $e->getCode() ){

				case 1044:
                    $message = 'Usuari y/o Clau incorrecte';
					break;
				case 1049:
                    $message = 'Base de dades desconeguda';
					break;
				case 2002:
                    $message = 'No es trova servidor';
					break;
				default:
					$message = $e->getCode().' - '.$e->getMessage();
					break;
                }

		}

        return $message;

	}

}

?>
