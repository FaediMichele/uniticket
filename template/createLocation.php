 <div class="col-11 contenuti pt-3">
     <!-- Title -->
     <div class="row">
         <div class="col-12">
             <input type="title" name="eventTitle" placeholder="Nome edificio es: Energy" class="input input-max-width"
                 id="title" />
         </div>
     </div>

     <!-- pulsante crea stanza -->
     <div class="row">
         <div class="col-12">
             <button class="button-orange text-uppercase">Crea stanza</button>
         </div>
     </div>

     <!--cerchi di separazione-->
     <div class="row mb-5 mt-5">
         <div class="separate">
             <div class="circle"></div>
             <div class="circle"></div>
             <div class="circle"></div>
         </div>
     </div>


     <!-- seleziona locale -->
     <div class="row">
         <div class="col-12">
             <div class="input">
                 <select class="form-control" onChange="changeRoom(this.value)" id="place">
                     <?php   
                                $array = $dbh->getLocationsAndRoom($_COOKIE["sessionId"]);
                                $locationData = json_encode($array);
                                $keys = array_keys($array);
                                for($i=0; $i < count($keys); $i++){
                                    echo '<option value="' . strval($keys[$i]) . '">' . strval($keys[$i]) . '</option>';
                                }
                        ?>
                 </select>
             </div>
         </div>
     </div>

     <!-- capienza sala -->
     <div class="row">
         <div class="col-4">
             <input type="capienza" name="eventPrice" placeholder="capienza" class="input input-max-width" id="price" />
         </div>
         <div class="col-8 pl-0">
             <input type="title" name="eventTitle" placeholder="Nome Stanza es: Blue" class="input input-max-width"
                 id="title" />
         </div>
     </div>

     <!-- pulsnate crea sala -->
     <div class="row">
         <div class="col-12">
             <button class="button-orange text-uppercase">Crea sala</button>
         </div>
     </div>
 </div>