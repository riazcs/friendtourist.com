
            // Pameny Method Check
            $(document).on('click', '#payment_method', function(e){
                e.preventDefault();
                removeAllCheck();
                 $('#payment_method').html(`<div style="padding: 6px;
                                             box-shadow: 0px 1px 4px darkgrey;
                                             border-radius: 5px; text-align: center; cursor: pointer; position: relative; width: 100%; overflow: hidden; height: 80px;">
                                           
                                                 <div>
                                                     <div>
                                                         <span style="font-size: 18px;"><i class="far fa-credit-card"></i></span>
                                                     </div>
                                                     <div><h3 style="font-size: 16px; font-weight: 600; color: #1c3c6b;">Credit/Debit Card</h3></div>
                                                 </div>
 
                                                 <div id="remove_checked" style="position: absolute; top: 0; right: 0;">
                                                     <div style="width: 24px;
                                                     height: 24px;
                                                     border-radius: 50%;
                                                     background-color: #FEBB02;">
                                                         <span style="font-size: 15px;
                                                         font-weight: 200;
                                                         padding: 5px; color: #333;">
                                                             <i class="fas fa-check"></i>
                                                         </span>
                                                     </div>
                                                 </div></div>`);
             });
 
             $(document).on('click', '#payment_method1', function(e){
                e.preventDefault();
                removeAllCheck();
                 $('#payment_method1').html(`<div style="padding: 6px;
                                             box-shadow: 0px 1px 4px darkgrey;
                                             border-radius: 5px; text-align: center; cursor: pointer; position: relative; width: 100%; overflow: hidden; height: 80px;">
                                           
                                             <div>
                                                     <div>
                                                         <span style="font-size: 18px;"><i class="fas fa-mobile-alt"></i></span>
                                                     </div>
                                                     <div><h3 style="font-size: 16px; font-weight: 600; color: #1c3c6b;">Mobile Banking</h3></div>
                                                 </div>
 
                                                 <div id="remove_checked1" style="position: absolute; top: 0; right: 0;">
                                                     <div style="width: 24px;
                                                     height: 24px;
                                                     border-radius: 50%;
                                                     background-color: #FEBB02;">
                                                         <span style="font-size: 15px;
                                                         font-weight: 200;
                                                         padding: 5px; color: #333;">
                                                             <i class="fas fa-check"></i>
                                                         </span>
                                                     </div>
                                                 </div>
                                                 </div>`);
             });
 
             $(document).on('click', '#payment_method2', function(e){
                e.preventDefault();
                removeAllCheck();
                 $('#payment_method2').html(`<div style="padding: 6px;
                                             box-shadow: 0px 1px 4px darkgrey;
                                             border-radius: 5px; text-align: center; cursor: pointer; position: relative; width: 100%; overflow: hidden; height: 80px;">
                                           
                                             <div>
                                                     <div>
                                                         <span style="font-size: 18px;"><i class="fas fa-globe-asia"></i></span>
                                                     </div>
                                                     <div><h3 style="font-size: 16px; font-weight: 600; color: #1c3c6b;">Net Banking</h3></div>
                                                 </div>
 
                                                 <div id="remove_checked2" style="position: absolute; top: 0; right: 0;">
                                                     <div style="width: 24px;
                                                     height: 24px;
                                                     border-radius: 50%;
                                                     background-color: #FEBB02;">
                                                         <span style="font-size: 15px;
                                                         font-weight: 200;
                                                         padding: 5px; color: #333;">
                                                             <i class="fas fa-check"></i>
                                                         </span>
                                                     </div>
                                                 </div>
                                                 </div>`);
             });
 
             $(document).on('click', '#payment_method3', function(e){
                e.preventDefault();
                removeAllCheck();
                 $('#payment_method3').html(`<div style="padding: 6px;
                                             box-shadow: 0px 1px 4px darkgrey;
                                             border-radius: 5px; text-align: center; cursor: pointer; position: relative; width: 100%; overflow: hidden; height: 80px;">
                                           
                                             <div>
                                                     <div>
                                                         <span style="font-size: 18px;"><i class="fas fa-home"></i></span>
                                                     </div>
                                                     <div><h3 style="font-size: 16px; font-weight: 600; color: #1c3c6b;">EMI</h3></div>
                                                 </div>
 
                                                 <div id="remove_checked3" style="position: absolute; top: 0; right: 0;">
                                                     <div style="width: 24px;
                                                     height: 24px;
                                                     border-radius: 50%;
                                                     background-color: #FEBB02;">
                                                         <span style="font-size: 15px;
                                                         font-weight: 200;
                                                         padding: 5px; color: #333;">
                                                             <i class="fas fa-check"></i>
                                                         </span>
                                                     </div>
                                                 </div>
                                                 </div>`);
             });
 // Check Mark Remove Function
             var removeAllCheck = function(){
                 try{
                     $("#remove_checked").remove();
                     $("#remove_checked1").remove();
                     $("#remove_checked2").remove();
                     $("#remove_checked3").remove();
                 }catch(e){}
             };
 
 
 
 // Cart add
          let x = 0;
          document.getElementById('output-area').innerHTML = x;
          function button1() {
            document.getElementById('output-area').innerHTML = ++x;
           }
           function button2() {
           document.getElementById('output-area').innerHTML = --x;
           }
 
           let i = 0;
 
           document.getElementById('output-area-fous').innerHTML = i;
           function button3() {
             document.getElementById('output-area-fous').innerHTML = ++i;
             
             }
   
             function button4() {
             document.getElementById('output-area-fous').innerHTML = --i;
 
             }
 
 // Check Out 
             $(document).on('click','#select_room', function(e){
               e.preventDefault();
 
               if(x>0){
                 let taka = x*6917;
                 let discount = taka - 2000;
                 
                 $("#check_out_click").html(`<div style="width:40%; height: auto; border: 1px dashed #fff; border-radius: 3px; text-align: center !important;color: #fff;position: relative; padding: 0px;" class="alert alert-dismissible" role="alert">
                 <div style="width:100%; height: auto;padding: 10px; ">
                   <h3 style="color: #fff;
                   font-size: 19px;
                   font-weight: 400;">SUITE ROOM SEA SIDE</h3>
 
                 <div class="d-flex justify-content-between">
                     <div> <p style="margin-bottom: 0px; font-size: 14px; font-weight: 400;">Adult: 2</p></div>
                     <div> <p style="margin-bottom: 0px; font-size: 14px; font-weight: 400;">BDT: ${taka}</p></div>
             </div>
 
           </div>
 
            <button style="position: absolute;
            top: -7px;
            color: #fff;
            right: 0px;
            font-weight: 100;
            font-size: 22px; padding: 0px;" type="button" class="close" data-dismiss="alert" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
             </div>`);
 
 
 
             $("#card_checkout_right").html(`<div style="width:25%; height: auto; text-align: right !important;color: #fff;" class="ml-auto">
               <p style="margin-bottom: 0px; font-size: 15px; font-weight: 200;">Total</p>
         <div class="d-flex justify-content-between">
          <div>
           <h3 style="color: #b0dfee;
            font-size: 13px;
            font-weight: 400;"><del>BDT: ${taka}</del></h3>
           </div>
 
           <div>
           <h3 style="color: #fff;
            font-size: 16px;
            font-weight: 500;">${discount}</h3>
           </div>
           </div>
 
            <a style="padding: 3px 40px;" class="btn btn-light btn-sm" href="booking_confirm.html">Next</a>
          
             </div>`);
 
               }
              
             });
 
 
 
 
 
 
 
 
 
 
             //Mobile Responsive
             $(document).on('click','#select_room', function(e){
               e.preventDefault();
             if(i>0){
                 let taka = i*6917;
                 let discount = taka - 2000;
                 
                 $("#check_out_click").html(`<div id="mobile-responsive" style="width:40%; height: auto; border: 1px dashed #fff; border-radius: 3px; text-align: center !important;color: #fff;position: relative; padding: 0px;" class="alert alert-dismissible" role="alert">
                 <div style="width:100%; height: auto;padding: 10px; ">
                   <h3 style="color: #fff;
                   font-size: 19px;
                   font-weight: 400;" id="suit-h3-tag">SUITE ROOM SEA SIDE</h3>
 
                 <div class="d-flex justify-content-between">
                     <div> <p style="margin-bottom: 0px; font-size: 14px; font-weight: 400;">Adult: 2</p></div>
                     <div> <p style="margin-bottom: 0px; font-size: 14px; font-weight: 400;">BDT: ${taka}</p></div>
             </div>
 
           </div>
 
            <button style="position: absolute;
            top: -7px;
            color: #fff;
            right: 0px;
            font-weight: 100;
            font-size: 22px; padding: 0px;" type="button" class="close" data-dismiss="alert" aria-label="Close">
             <span aria-hidden="true">&times;</span>
           </button>
             </div>`);
 
 
 
             $("#card_checkout_right").html(`<div id="mobile-responsive-right" style="width:25%; height: auto; text-align: right !important;color: #fff;" class="ml-auto">
               <p style="margin-bottom: 0px; font-size: 15px; font-weight: 200;">Total</p>
         <div class="d-flex justify-content-between">
          <div>
           <h3 style="color: #b0dfee;
            font-size: 13px;
            font-weight: 400;"><del>BDT: ${taka}</del></h3>
           </div>
 
           <div>
           <h3 style="color: #fff;
            font-size: 16px;
            font-weight: 500;">${discount}</h3>
           </div>
           </div>
 
            <a style="padding: 3px 40px;" class="btn btn-light btn-sm" href="booking_confirm.html">Next</a>
          
             </div>`);
 
               }
              
             });
 
 
 