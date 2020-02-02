<div class="col-11 contenuti" id="createEvent">
    <form id="form-addEvent" action="phpFunctions/newEvent.php" method="POST" enctype="multipart/form-data">

        <!-- image input -->
        <div class="row mb-3 pb-3 pt-2 background-light-grey inputImage">
            <div class="col-12">
                <!-- images -->
                <div id="createEventCarousel" class="carousel slide carousel-fixed row pr-1 pl-1 mb-3"
                    data-ride="carousel">
                    <!--<ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                        </ol> -->
                    <div id="images" class="carousel-inner" role="listbox">
                        <!-- do not remove this image, only change the src -->
                        <div class="carousel-item row d-flex justify-content-center active">
                            <div class="col-3 float-left ml-1 overlay-father" onclick="clickImage(this)">
                                <img class=" img-fluid" src="img/locandina.jpg" />
                                <div class="overlay-text-centered"></div>
                            </div>
                            <!-- other div will be added here -->
                        </div>
                        <!-- other carousel- item will be added here -->
                    </div> <!-- onclick="tmp()" : da migliorare, verrà utilizzato per centrare le immagini -->
                    <a class="carousel-control-prev" href="#createEventCarousel" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#createEventCarousel" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
                <div class="row mb-1 d-flex justify-content-center">
                    <button class="button-red col-5 text-uppercase mr-2" type="button" onClick="removeImage()">Rimuovi
                        selezionati</button>
                    <button class="button-orange col-6 text-uppercase" type="button">Imposta come principale</button>
                </div>
                <div class="row d-flex justify-content-center ">
                    <input id="insert-image" type="file" multiple class="form-control-file" accept="image/*">
                    <label for="insert-image"
                        class="col-7 button-white text-uppercase text-center text-vertical-center-father">
                        <p class="text-vertical-center-son"> Carica una nuova immagine</P>
                    </label>
                </div>
            </div>
        </div>

        <!-- Title -->
        <div class="row">
            <div class="col-12">
                <input type="text" name="eventTitle" placeholder="Titolo" class="input input-max-width" id="title" />
            </div>
        </div>

        <!-- data, ora -->
        <div class="row ">
            <div class="col-6">
                <input type="date" name="eventDate" placeholder="Date" class="input input-max-width" id="date" />
            </div>
            <div class="col-6 pl-0">
                <div class="input">
                    <p class="text-center">ora(24) : minuti</p>
                </div>
            </div>
        </div>

        <!-- locale -->
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
        <!-- prezzo, sala -->
        <div class="row">
            <div class="col-5">
                <input type="number" min="0" max="9999.9" step="0.01" name="eventPrice" placeholder="Price"
                    class="input input-max-width" id="price"
                    onkeydown="return event.keyCode !== 69 && event.keyCode !== 189" />
                <!-- toglie la e (si usa per l esponenziale) -->

            </div>
            <div class="col-7 pl-0">
                <div class="input">
                    <select class="form-control" onChange="roomSelected()" id="room">
                        <!-- room will be added here by client -->
                    </select>
                </div>
            </div>
        </div>

        <!-- Artista -->
        <div class="row">
            <div class="col-12">
                <input type="artist" name="eventArtist" placeholder="Artista" class="input input-max-width"
                    id="artist" />
            </div>
        </div>

        <!-- Description -->
        <div class="row">
            <div class="col-12">
                <input type="text" name="eventDescription" placeholder="Descrizione" class="input input-max-width"
                    id="description" />
            </div>
        </div>

        <!-- go to singUp page -->
        <div class="row">
            <div class="col-12">
                <input type="button" onclick="uploadEvent()" value="PUBBLICA EVENTO" name="submit"
                    class="button-orange" />
            </div>
        </div>
        <div id="hiddenRoom"></div> <!-- room id -->
        <div id="hiddenImage"></div><!-- image data -->
        <div id="hiddenImageNumber"></div> <!-- image numbers -->

    </form>

</div>


<script>
var imageCount = 0;
var locationData;
var nextSelectedImageNum = 1;
var imgSelected = [];

function clearSelectedImage() {
    $(".overlay-selected").removeClass("overlay-selected");
    $(".overlay-text-centered").empty();
    nextSelectedImageNum = 1;
    $("#hiddenImageNumber input").val = "-1";
}

function clickImage(usedDiv) {
    if (imageCount == 0) {
        return;
    }
    if (usedDiv.children[0].classList.contains("overlay-selected")) {
        clearSelectedImage();
    } else {
        usedDiv.children[0].classList.add("overlay-selected");
        usedDiv.children[1].innerHTML = nextSelectedImageNum;
        $("#hiddenImageNumber input:nth-child(" + usedDiv.children[0].id.split("-")[1] + ")").val(nextSelectedImageNum);

        nextSelectedImageNum++;
    }
}

function formatImage() {
    var index = 1;
    while ($("#images > .carousel-item:nth-child(" + (index + 1) + ")").length) {
        console.log($("#images > .carousel-item:nth-child(" + index + ") > div").length);
        console.log($("#images > .carousel-item:nth-child(" + (index + 1) + ")"));
        console.log("Lezzo");
        while ($("#images > .carousel-item:nth-child(" + index + ") > div").length < 3 &&
            $("#images > .carousel-item:nth-child(" + (index + 1) + ")").length) {

            $("#images > .carousel-item:nth-child(" + (index + 1) + ") > div:nth-child(1)")
                .appendTo($("#images > .carousel-item:nth-child(" + index + ")"));

            console.log($("#images > .carousel-item:nth-child(" + index + ") > div").length);
            // se vuoto rimuove il gruppo dopo
            if ($("#images .carousel-item:nth-child(" + (index + 1) + ") > div").length == 0) {
                $("#images .carousel-item:nth-child(" + (index + 1) + ")").remove();
            }
        }
        index++;
    }
}

function formatId() {
    $("#hiddenImage").empty();
    $("#hiddenImageNumber").empty();
    var idAssigned = 1;
    $("#images .carousel-item img").each(function(index) {
        $(this).attr("id", "image-" + idAssigned);
        $("#hiddenImage").append(
            '<input type="hidden" name="image' + idAssigned + '" value="' + $(this).attr("src") + '" >');
        $("#hiddenImageNumber").append(' <input id="imageNumber-' +
            idAssigned + '" type = "hidden" name = "imageNumbers[]" value = "-1" > ');
        idAssigned++;
    });
    clearSelectedImage();
}

function loadFile(event) {
    if (event.files && event.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {

            if (imageCount % 3 == 0) {
                if (imageCount == 0) {
                    $("#images").empty();
                    $("#images").append(
                        '<div class="carousel-item row d-flex justify-content-center active"></div>');
                } else {
                    $("#images").append('<div class="carousel-item row"></div>');
                }
            }
            console.log(imageCount);

            $("#images > div:last-child").append(
                '<div class="col-4 float-left overlay-father pl-0" onclick="clickImage(this)"><img id="image-' +
                (imageCount + 1) + '" class="img-fluid" src="' +
                e.target.result + '" alt="immagine n°' + (imageCount + 1) +
                '" /><div class="overlay-text-centered"></div></div>');

            imageCount++;



            $("#hiddenImage").append(
                '<input type="hidden" name="image' + imageCount + '" value="' + e.target.result + '" >');
            $("#hiddenImageNumber").append(' <input id="imageNumber-' +
                imageCount + '" type = "hidden" name = "imageNumbers[]" value = "-1" > ');

            var img = $("#images img:last-child");
            if (img.width() * img.height() > 100000) {
                alert("Image size not supported (4/3 or 1/1, height = (300 - 400)");
                $("#hiddenImage input").last().remove();
                if (imageCount > 1) {
                    $("#images").last().remove();
                }
                imageCount--;
                return;
            }
        }
        reader.readAsDataURL(event.files[0]);
    }
}
$(document).ready(function() {
    $('.carousel').carousel({
        interval: 2000000
    });

    // Dovrebbe centrare le cose ma fa uno scatto oribile
    /*$('#createEventCarousel').on('slid.bs.carousel', function() {
        $("#images .justify-content-center").removeClass("d-flex justify-content-center");
        $("#images .active").addClass("d-flex justify-content-center");
    });*/
    locationData = $.parseJSON('<?php echo $locationData; ?>');
    changeRoom();
    $("#insert-image").change(function() {
        loadFile(this);
    });
});

function uploadEvent(event) {
    if (imageCount == 0 || !$("#title").length || !$("#date").length ||
        !$("#price").val.length || !$("#artist").length || !$("#description").length ||
        nextSelectedImageNum != imageCount - 1 || parseFloat($("#price").val()) < 0 ||
        parseFloat($("#price").val()) > 9999 ||
        (new Date($("#date").val()).getTime() - new Date().getTime()) / (1000 * 60 * 60 * 24) < 2) {
        alert("Dati non corretti");
        return;
    }
    $("#form-addEvent").submit();
}


function changeRoom() {
    $("#room").empty();
    Object.keys(locationData[$("#place").val()]).forEach(function(val, index) {
        $("#room").append('<option value="' +
            locationData[$("#place").val()][val] + '">' + val + '</option>');
    });
    roomSelected();
}

function roomSelected() {
    var e = document.getElementById("room");
    $("#hiddenRoom").empty();
    $("#hiddenRoom").append('<input type="hidden" type="text" name="idRoom" value="' +
        e.options[e.selectedIndex].value + '" >');
}

function removeImage() {
    // devo eliminare le immagini, le hidden image e le hidden imagenumber. sono tutti in fila.
    // potrei selezionare l'indice dell'immagine selezionata e tramite esso cancellare le cose.
    if (imageCount == 1) {
        alert("non puoi togliere la prima immagine");
        return;
    }

    Array.prototype.forEach.call(document.getElementsByClassName("overlay-selected"), function(element) {
        var tripletIndex = Array.from(element.parentNode.parentNode.parentNode.children).indexOf(element
            .parentNode.parentNode) + 1;
        var index = Array.from(element.parentNode.parentNode.children).indexOf(element.parentNode) + 1;

        $("#images .carousel-item:nth-child(" + tripletIndex + ") .overlay-father:nth-child(" + index + ")")
            .remove();
        // rimuove i gruppi vuoti
        if ($("#images .carousel-item:nth-child(" + tripletIndex + ") > div").length == 0) {
            $("#images .carousel-item:nth-child(" + tripletIndex + ")").remove();
        }
        imageCount--;
    });
    $("#images .active").removeClass("active");
    $("#images .carousel-item:nth-child(1)").addClass("active");
    formatId();
    formatImage();
}
</script>