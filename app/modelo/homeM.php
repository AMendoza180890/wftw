<?php
require_once 'conexionBD.php';
class dashboardHomeM extends conexionBD{
    public static function dashboardRecursosM(){
        try {
            $pdo = conexionBD::conexion()->prepare("SELECT count(id) as total FROM seccioncampaign");
            //if ($pdo->execute()) {
                return (($pdo->execute()) ? $pdo->fetch():$pdo->execute());
            //}
        } catch (exception $ex) {
            echo 'Error -'.$ex;
        }
    }
    
    Public static function dashboardUsuariosM(){
        try {
            $pdo = conexionBD::conexion()->prepare("SELECT count(id) as total FROM usuarios");

            //if ($pdo->execute()) {
                return (($pdo->execute()) ? $pdo->fetch():$pdo->execute());
            //}
        } catch (exception $ex) {
            echo 'Error -'.$ex;
        }
    }

    public static function dashboardUsuariosInvitadosM(){
        try {
            $pdo = conexionBD::conexion()->prepare("SELECT count(id) as total FROM usuarios WHERE rolid = 2");

            //if ($pdo->execute()) {
                return (($pdo->execute()) ? $pdo->fetch():$pdo->execute());
            //}
        } catch (exception $ex) {
            echo 'Error -'.$ex;
        }
    }

    public static function dashboardUsuariosAdministradoresM(){
        try {
            $pdo = conexionBD::conexion()->prepare("SELECT count(id) as total FROM usuarios WHERE rolid = 1");

            //if ($pdo->execute()) {
                return (($pdo->execute()) ? $pdo->fetch():$pdo->execute());
            //}
        } catch (exception $ex) {
            echo 'Error -'.$ex;
        }
    }

    public static function dashboardRecursosPorCategoriasM(){
        try {
            $query = "SELECT catetiquetas.etiquetaDescripcion as etiqueta, count(catrecursos.id) as total FROM catrecursos inner join unionetiquetascatrecurso on catrecursos.id = unionetiquetascatrecurso.idRecurso inner join catetiquetas on unionetiquetascatrecurso.idEtiqueta = catetiquetas.id group by catetiquetas.etiquetaDescripcion";
            $pdo = conexionBD::conexion()->prepare($query);

            //if ($pdo->execute()) {
                return (($pdo->execute()) ? $pdo->fetchAll(): $pdo->execute());
            //}
        } catch (exception $ex) {
            // echo '<script>Console.log("Error -'.print($ex->getMessage()).'");</script>';
            return false;
        }
    }
}
?>