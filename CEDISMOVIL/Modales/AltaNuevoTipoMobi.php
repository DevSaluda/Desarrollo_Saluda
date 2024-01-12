<div class="modal fade bd-example-modal-xl" id="AltaTiposMobiliario" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-notify modal-success">
        <div class="modal-content">

            <div class="text-center">
                <div class="modal-header">
                    <p class="heading lead">Añadiendo nuevo tipo de mobiliario</p>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true" class="white-text">&times;</span>
                    </button>
                </div>
                <div class="alert alert-success alert-styled-left text-blue-800 content-group">
                    <span class="text-semibold">Estimado usuario, </span>
                    los campos con un <span class="text-danger"> * </span> son campos necesarios para el correcto ingreso de datos.

                    <button type="button" class="close" data-dismiss="alert">×</button>
                </div>
                <div class="modal-body">

                    <form action="javascript:void(0)" method="post" id="AgregaTipoMobiliario">



                        <label for="exampleFormControlInput1">Folio <span class="text-danger">AUTOGENERADO</span> </label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend"> <span class="input-group-text" id="Tarjeta"><i class="fas fa-receipt"></i></span>
                            </div>
                            <input type="text" class="form-control "  readonly maxlength="60">
                        </div>



                        <label for="exampleFormControlInput1">Nombre del tipo de producto <span class="text-danger">*</span></label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">

                                <span class="input-group-text" id="Tarjeta"><i class="fas fa-file-signature"></i></span>
                            </div>
                            <input type="text" class="form-control " name="NombreTipoMobi" id="nombretipomobi" placeholder="Por ejemplo: Antibiotico" aria-describedby="basic-addon1" maxlength="60">
                        </div>
                        <div><label for="nombremarca" class="error">
                        </div>
                        <label for="exampleFormControlInput1">Vigencia <span class="text-danger">*</span></label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">

                                <span class="input-group-text" id="Tarjeta"><i class="fas fa-headset"></i></span>
                            </div>
                            <select name="VigenciaMobi" class="form-control" id="vigenciatipomobi" onchange="TipoVigenciaTiposProductos();">
                                <option value="">Elige un estatus</option>


                                <option value="background-color:#2BBB1D!important;">Vigente</option>
                                <option value="background-color:#ff6c0c!important;">Próximamente</option>
                            </select>
                        </div>
                        <div><label for="vigencia" class="error">
                        </div>


                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col" style="background-color: #00c851 !important;">Estatus de categoría</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <button id="SiVigenteTipoProd" class="divOculto3 btn btn-default btn-sm" style="background-color:#2BBB1D!important;">Vigente</butto>

                                        <button id="QuizasproximoTipoProd" class="divOculto3 btn btn-default btn-sm" style="background-color: #ff6c0c !important;">Próximamente</button>
                                        </td>
                                    </tr>


                                </tbody>
                            </table>
                        </div>
                        <input type="text" class="form-control " hidden  readonly id="usuariom" name="UsuarioTPM"  readonly value="<?echo $row['Nombre_Apellidos']?>">
                        <input type="text" class="form-control " hidden  readonly name="VigenciaTPM" id="vigenciatipomobid">
                        <input type="text" class="form-control " hidden  readonly id="sistema" name="SistemaTPM" readonly value="POS <?echo $row['Nombre_rol']?>">
                        <input type="text" class="form-control " hidden id="empresam" name="EmpresaTPM" readonly value="<?echo $row['ID_H_O_D']?>">
                        <div>

                            <button type="submit" name="submit_registro" id="submit_registro" value="Guardar" class="btn btn-success">Guardar <i class="fas fa-save"></i></button>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
</div>
<script type="text/javascript">
    function TipoVigenciaTiposProductos() {


        /* Para obtener el texto */
        var combo = document.getElementById("vigenciatipomobi");
        var selected = combo.options[combo.selectedIndex].text;
        $("#vigenciatipomobid").val(selected);
    }


    $(function() {


        $("#vigenciatipomobi").on('change', function() {

            var selectValue = $(this).val();
            switch (selectValue) {

                case "background-color:#2BBB1D!important;":
                    $("#SiVigenteTipoProd").show();

                    $("#NoVigenteMarcas").hide();
                    $("#QuizasproximoTipoProd").hide();

                    break;

               
                case "background-color:#ff6c0c!important;":
                    $("#QuizasproximoTipoProd").show();
                    $("#NoVigenteMarcas").hide();
                    $("#SiVigenteTipoProd").hide();



                    break;
                case "":
                    $("#NoVigenteMarcas").hide();
                    $("#QuizasproximoTipoProd").hide();
                    $("#SiVigenteTipoProd").hide();



                    break;



            }

        }).change();

    });
</script>

<style>
    .divOculto3 {
        display: none;
    }
</style>