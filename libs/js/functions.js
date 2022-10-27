function delete_function(id,locationhref){
    var href = locationhref.concat(id);
    window.location=href;
}

function delete_button(objeto){

    var padre=objeto.parentNode.parentNode;
    padre.remove();
}

function actualizardolar(){
    
    $('button[name=update_dolar]').click(function(e) {
        var dolar = {
             'dolar_value' : $('input[name=value_dolar]').val()
         };
         
         if(dolar['dolar_value'].length >= 1){
           // process the form
           $.ajax({
               type        : 'POST',
               url         : 'ajax.php',
               data        :  dolar,
               dataType    : 'json',
               encode      : true
           })
               .done(function(data) {
                   console.log(data);
               if(data.toString()==='true'){
                   alert("$$$ Dolar actualizado correctamente");
                   location.reload();
               }else{
                   alert("Error al actualizar el dolar");
               }
               });
               
        }
           
       
       
    });
}

function suggetionCajas() {
     $('#sug_input_list').keyup(function(e) {
         var formDataClient = {
             'caja_name' : $('input[name=title_caja]').val()
         };
  
         if(formDataClient['caja_name'].length >= 1){
           // process the form
           $.ajax({
               type        : 'POST',
               url         : 'ajax.php',
               data        : formDataClient,
               dataType    : 'json',
               encode      : true
           })
               .done(function(data) { 
                $asd = data ;
                $patron = /[0123456789]/g,
                $nuevoValor    = " ",
               // $nuevaCadena = $asd.replace($patron, $nuevoValor);
                $nuevaCadena = data ;
                
                   $('#result').html($nuevaCadena).fadeIn();
                   $('#result li').click(function(e) {

                    var data = $(this).text() ;
                    var array = data.split(' ');
                      
                       $name = "";
                       //concateno el nombre obtenido de ajax
                            for (var i = 1, max = 10; i < max; i++) {
                                if(array[i]){
                                    $name += array[i]+" " ;
                                }
                            }
                     $('#sug_input_list').val($name);
                     
                     
        var ultimo_dato = {
             'caja_name' : $(this).text().trim()
         };
         
         if((ultimo_dato.caja_name[1]) == " "){
         $('#setcaja').val(ultimo_dato.caja_name[0]);
         }else if ((ultimo_dato.caja_name[2]) == " ") {      
                          $('#setcaja').val(ultimo_dato.caja_name[0] + ultimo_dato.caja_name[1]);      
                            }else if ((ultimo_dato.caja_name[3]) == " ") {      
                          $('#setcaja').val(ultimo_dato.caja_name[0] + ultimo_dato.caja_name[1]+ ultimo_dato.caja_name[2]);      
                            }

       /*  if(ultimo_dato['caja_name'].length >= 1){
                    // process the form
                    $.ajax({
                        type        : 'POST',
                        url         : 'ajax.php',
                        data        : ultimo_dato,
                        dataType    : 'json',
                        encode      : true
                    }).done(function(data){
                        $asd = data ;
                        $patron = /[0123456789]/g,
                        $nuevoValor    = " ",
                        $nuevaCadena = $asd.replace($patron, $nuevoValor);
                                     //si no existe 29, es de una cifra
                                     if ($asd.charAt (29) == " ") {
                                         $('#setcaja').val($asd.charAt (28));
                                         //si no existe el 30 previa existensia del 29 es de dos cifras
                                     }else if ($asd.charAt (30) == " ") {
                                         $('#setcaja').val($asd.charAt (28)+$asd.charAt (29));  
                                         //no existe el 31 previa existensia del 30 es de tres cifras
                                     }else if ($asd.charAt (31) == " "){
                                         $('#setcaja').val($asd.charAt (28)+$asd.charAt (29)+$asd.charAt (30)); 
                                     }else{
                                        $('#setcaja').val($asd.charAt (28)+$asd.charAt (29)+$asd.charAt (30)+$asd.charAt (31));  
                                     }
                                  })
           
            }else{
                console.log("error general");
            } */
                     
            
                            $('#result').fadeOut(500);
                   });

                   $("#sug_input_list").blur(function(e){
                     $("#result").fadeOut(500);
                   });
                   
                 

               });
               
         } else {
     
           $("#result").hide();

         };

         e.preventDefault();
     });

     
 }  
 
 
 


function suggetion() {

     $('#sug_input').keyup(function(e) {

         var formData = {
             'product_name' : $('input[name=title]').val()
         };

         if(formData['product_name'].length >= 1){

           // process the form
           $.ajax({
               type        : 'POST',
               url         : 'ajax.php',
               data        : formData,
               dataType    : 'json',
               encode      : true
           })
               .done(function(data) {
                   //console.log(data);
                   $('#result').html(data).fadeIn();
                   $('#result li').click(function() {

                     $('#sug_input').val($(this).text());
                     $('#result').fadeOut(500);

                   });

                   $("#sug_input").blur(function(){
                     $("#result").fadeOut(500);
                   });

               });

         } else {

           $("#result").hide();

         };

         e.preventDefault();
     });

 }
  $('#sug-form').submit(function(e) {
      var formData = {
          'prod_name' : $('input[name=title]').val()
      };
        // process the form
        $.ajax({
            type        : 'POST',
            url         : 'ajax.php',
            data        : formData,
            dataType    : 'json',
            encode      : true
        })
        
            .done(function(data) {
                //console.log(data);
                var node = $('#product_info:last-child');
                node.append(data).show();
                total();
                $('.datePicker').datepicker('update', new Date());
              
            }).fail(function() {
                $('#product_info').html(data).show();
            });
      e.preventDefault();
  });
  function total(){
    $('#product_info input[name="quantity"]').change(function(e)  {
     var arr = [] ;  
      
    $('#product_info tr').each(function(indice, elemento) {
      
        $name = $(this).text();
     
         var formDataStock = {
             'id' : $(this).find('input[name=s_id]').val(),
             'qty' : $(this).find('input[name=quantity]').val()
         };
         
         arr.push(formDataStock);
           
            });
            
           $('#product_info tr').each(function(indice, elemento) {
           
            $price = +$(this).find('input[name=price]').val() || 0;
            $qty = +$(this).find('input[name=quantity]').val() || 0;
            $total = $qty * $price;
            $(this).find('input[name=total]').val($total.toFixed(2));
            
            arr.forEach(function(element) {
                
                 $.ajax({
                    type        : 'POST',
                    url         : 'ajax.php',
                    data        : element,
                    dataType    : 'json',
                    encode      : true,
                    complete: function (data) {
                        
                         var hijo = $("#product_info tr td#"+element.id);
                         var padre = hijo.parent();
                         var className = padre.find('input[name=quantity]').attr('class');

                        if (data.responseJSON === "True"){                            
                            if(className === "qtylow"){                                 
                                padre.find('input[name=quantity]').removeClass("qtylow").addClass("form-control");  
                            }
                          
                        }else{
                            if(className === "form-control"){                                
                                padre.find('input[name=quantity]').removeClass("form-control").addClass("qtylow"); 
                            }
                        }
                    }
                });
                
              });
          });
   
   });
  }

  $(document).ready(function() {
      
    //tooltip
    $('[data-toggle="tooltip"]').tooltip();

    $('.submenu-toggle').click(function () {
       $(this).parent().children('ul.submenu').toggle(200);
    });
    //suggetion for finding product names
    suggetion();
    suggetionCajas();
    actualizardolar();

    // Callculate total ammont
    total();

    $('.datepicker')
        .datepicker({
            format: 'yyyy-mm-dd',
            todayHighlight: true,
            autoclose: true
        });
                
  });
  

  
function numeroAleatorio() {
  return Math.round(Math.random() * (10000 - 1) + 1);
}


//add stock to multiple products selected
$("th input[name='input_stock']").change(function(e){
    var value = parseInt($(this).val());
    
         $('#table_products tr').each(function(indice, elemento){
         
            if($(this).find("input[name='check']").is(":checked")){
                var valorActual = parseInt($(this).find("#stockqty").html());
                var resultado = valorActual + value ;
                
                $(this).find("#stockqty").html(resultado);
            }
         
         });
    
});

//add buy price percent to multiple products selected
$("th input[name='input_price']").change(function(e){
    var value =  parseFloat(($(this).val())).toFixed(2);
    
         $('#table_products tr').each(function(indice, elemento){
         
            if($(this).find("input[name='check']").is(":checked")){
                var valorActual = parseFloat(($(this).find("#buyprice").html())).toFixed(2);
                var r = (parseInt(value) + parseInt(valorActual)).toFixed(2) ;
                var porcentajeASumar = Math.round((( parseInt(value) * parseInt(valorActual) ) / 100)).toFixed(2);
                var resultado = (parseInt(valorActual) + parseInt(porcentajeASumar)).toFixed(2);

                $(this).find("#buyprice").html(resultado);
            }
         
         });
    
});
 
 //add sale price percent to multiple products selected
$("th input[name='input_price_sale']").change(function(e){
    var value =  parseFloat(($(this).val())).toFixed(2);
    
         $('#table_products tr').each(function(indice, elemento){
         
            if($(this).find("input[name='check']").is(":checked")){
                
                var valorActual = parseFloat(($(this).find("#saleprice").html())).toFixed(2);
                var r = (parseInt(value) + parseInt(valorActual)).toFixed(2) ;
                var porcentajeASumar = Math.round((( parseInt(value) * parseInt(valorActual) ) / 100)).toFixed(2);
                var resultado = (parseInt(valorActual) + parseInt(porcentajeASumar)).toFixed(2);

                $(this).find("#saleprice").html(resultado);
            }
         
         });
    
});
 
 //checking all products in edit multiple
$("th input[name='check_all']").click(function(){

    if($(this).is(":checked")){
        $('#table_products tr').each(function(indice, elemento){
        $(this).find("input[name='check']").prop("checked","checked");
        });
    }else{
            $('#table_products tr').each(function(indice, elemento){
            $(this).find("input[name='check']").removeAttr("checked");
            });
    }
    
});

//edit multiple products reset button
$( "button[name='reset_changes']" ).click(function() {
    location.reload(true);
});

//edit multiple products add changes button
$( "button[name='add_changes']" ).click(function() {
   $errors = false; 
         $('#table_products tr').each(function(indice, elemento){
 
            if($(this).find("input[name='check']").is(":checked")){
           
               var update_producto = {
                'id_producto' : $(this).children(":first").attr('id'),
                'qty_producto' : $(this).find("td[id='stockqty']").html(),
                'buy_producto' : $(this).find("td[id='buyprice']").html(),
                'sale_producto' : $(this).find("td[id='saleprice']").html()
                };
                
                
                $.ajax({
                    type        : 'POST',
                    url         : 'ajax.php',
                    data        : update_producto,
                    dataType    : 'json',
                    encode      : true,
                    complete: function (data) {
                        if(data === 'False'){
                           $errors = true;
                        }
                    }
                });
               
               
            }
         
         });
    if($errors){
        alert("Error al actualizar un producto");
    }else{
        alert("Productos actualizados correctamente");
    }
    location.reload(true);
});


$("[name='add_sale1']").on('click', function(evt){
    evt.preventDefault();
    evt.stopPropagation();
    var b = true;
    
    $('#product_info tr').each(function(indice, elemento) {
            $id = $(this).find('input[name=s_id]').val();
            $name = $(this).text();
            $precio = $(this).find('input[name=price]').val();
            $qty = $(this).find('input[name=quantity]').val();
            $total = $(this).find('input[name=total]').val();        
            $date = $(this).find('input[name=date]').val();
           var hijo = $("#product_info tr td#"+$id);
           var padre = hijo.parent();
           var className = padre.find('input[name=quantity]').attr('class');
        if (className === "qtylow"){
            alert("No hay stock para "+$name);
            //$(this).remove();
            b = false;
        }
        if ($qty.length < 1 || $total.length < 1 ){
            alert("Hay campos vacios");
            b= false; 
        }    
        
    });
        
    if(b){
     add_sale(this); 
    }
   
});

function add_sale(objeto){
    var array = [] ;  
           
      
    $('#product_info tr').each(function(indice, elemento) {
      
              var formDataSale = {
             'idp' : $(this).find('input[name=s_id]').val(),
             'name' : $(this).text(),
             'price' : $(this).find('input[name=price]').val(),
             'qty' : $(this).find('input[name=quantity]').val(),
             'total' : $(this).find('input[name=total]').val(),
             'date' : $(this).find('input[name=date]').val()
              };
              
             array.push(formDataSale);
           
            });
       
       
                array.forEach(function(element) {
                   $.ajax({         
                           type        : 'POST',
                           url         : 'ajax.php',
                           data        : element,
                           dataType    : 'json',
                           encode      : true,
                           complete: function (data) {
                              if(data.responseJSON === "True"){
                                  //alert(element.name + " agregado");
                               }else{
                                   alert("Error al agregar " +element.name );
                               }
                           }
                    }).then(function(data){
                        //console.log("ready");
                    });
                });
           alert("Venta agregada");    
           $(location).attr('href',"add_sale.php");
     

}