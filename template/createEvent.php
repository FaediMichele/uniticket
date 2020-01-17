<div class="col-11">
    <div class="row contenuti">
        <form id="form-addEvent">

            <!-- image input -->
            <div class="row">
                <div class="col-12">
                    <input type="file" class="form-control-file" accept="image/*" onchange="loadFile(event)">
                    <img id="output" class="img-thumbnail" src="img/locandina.jpg" />
                    <script>
                    var loadFile = function(event) {
                        var output = document.getElementById('output');
                        output.src = URL.createObjectURL(event.target.files[0]);
                    };
                    </script>
                </div>
            </div>


            <!-- Title -->
            <div class="row">
                <div class="col-12">
                    <input type="title" name="eventTitle" placeholder="Titolo" class="input input-max-width"
                        id="title" />
                </div>
            </div>

            <!-- data, locale -->
            <div class="row">
                <div class="col-5 mr-0">
                    <input type="date" name="eventDate" placeholder="Date" class="input input-max-width" id="data" />
                </div>
                <div class="col-7 ml-0">
                    <input type="place" name="eventPlace" placeholder="Luogo" class="input input-max-width"
                        id="place" />
                </div>
            </div>

            <!-- prezzo, sala -->
            <div class="row">
                <div class="col-5 mr-0">
                    <input type="price" name="eventPrice" placeholder="Price" class="input input-max-width"
                        id="price" />
                </div>
                <div class="col-7 ml-0">
                    <input type="room" name="eventRoom" placeholder="Stanza" class="input input-max-width" id="room" />
                </div>
            </div>

            <!-- Artista -->
            <div class="row">
                <div class="col-12">
                    <input type="artist" name="eventArtist" placeholder="Artista" class="input input-max-width"
                        id="artist" />
                </div>
            </div>

            <!-- Title -->
            <div class="row">
                <div class="col-12">
                    <input type="title" name="title" placeholder="Descrizione" class="input input-max-width"
                        id="title" />
                </div>
            </div>

            <!-- go to singUp page -->
            <div class="row">
                <div class="col-12">
                    <button class="button-orange" type="publishButton" id="publish" name="eventPublish" value=""
                        onclick="formAction()">PUBBLICA EVENTO</button>
                </div>
            </div>
        </form>
    </div>
</div>