<?php

class mensajeC {
    public function listademensaje(){
        try {
            $listamensaje = mensajeM::listademensajeM();
            if($listamensaje != 0){
                foreach ($listamensaje as $key => $value) {
                    echo '<tr>
                    <td>'.($key +1).'</td>
                    <td>'.$value["nombres"].'</td>
                    <td>'.$value["apellidos"].'</td>
                    <td>'.$value["tipoVoluntario"].'</td>
                    <td>'.$value["telefono"].'</td>
                    <td>'.$value["email"].'</td>
                    <td>'.$value["comentario"].'</td>
                    <td>
                        <div class="btn-group">
                            <button class="btn btn-success EditRegistromensaje" codValor='.$value["id"]. '><i data-toggle="modal" data-target="#editarmensaje" class="fa fa-pencil"></i></button>
                            <button class="btn btn-danger DesactivarRegistromensaje" codValor=' . $value["id"] . '><i class="fa fa-times"></i></button>
                        </div>
                    </td>
                </tr>';
                }
            }
        } catch (Exception $ex) {
            echo 'Error - '.$ex;
        }
    }
}
