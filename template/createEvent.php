<div class="col-12 contenuti" id="createEvent">
    <form id="form-addEvent" action="phpFunctions/newEvent.php" method="POST" enctype="multipart/form-data">

        <!-- image input -->
        <div class="row background-light-grey inputImage ">
            <div class="col-12">
                <div class="suggest hidden">
                </div>

                <!-- images -->
                <div class="row mb-3 mt-3">

                    <!-- freccia a sinistra -->
                    <div class="col-1 height-200 text-vertical-center-father m-0 p-0">
                        <a href="#createEventCarousel" class="text-vertical-center-son" role="button" data-slide="prev">
                            <p class="reset font-color-arrow text-right">
                                <i class="fas fa-chevron-left fa-2x"></i>
                                <span class="sr-only">Previous</span>
                            </p>
                        </a>
                    </div>

                    <!-- fine freccia a sinistra -->
                    <div class="col-10 m-0 p-0">
                        <!-- inizio carosello -->
                        <div id="createEventCarousel" class="carousel slide" data-ride="carousel">
                            <!--<ol class="carousel-indicators">
                                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                                </ol> -->

                            <div id="images" class="carousel-inner" role="listbox">

                                <!-- do not remove this image, only change the src -->
                                <div class="carousel-item d-flex justify-content-center active ">
                                    <div class="col-4 float-left ml-1 overlay-father" onclick="clickImage(this)">
                                        <img class="height-200 img-fluid cover-100-percent" src="img/locandina.jpg" alt="immagine simple del tuo evento" />
                                        <div class="overlay-text-centered"></div>
                                    </div>
                                    <!-- other div will be added here -->
                                </div>
                                <!-- other carousel- item will be added here -->
                            </div> <!-- onclick="tmp()" : da migliorare, verr?? utilizzato per centrare le immagini -->
                        </div>
                        <!-- fine carosello -->
                    </div>


                    <!-- freccia a destra  -->
                    <div class="col-1 height-200 text-vertical-center-father m-0 p-0">
                        <a class="text-vertical-center-son" href="#createEventCarousel" role="button" data-slide="next">
                            <p class="reset font-color-arrow">
                                <i class="fas fa-chevron-right fa-2x"></i>
                                <span class="sr-only">Next</span>
                            </p>
                        </a>
                    </div>
                    <!-- fine freccia a destra -->
                </div>



                <div class="row mb-1 d-flex justify-content-center">
                    <button class="button-red col-5 col-md-3 col-lg-2 text-uppercase mr-1" type="button" onClick="removeImage()">Rimuovi
                        selezione</button>
                    <button class="button-white col-5 col-md-3 col-lg-2 text-uppercase ml-1" onClick="changeOrder()" type="button">Cambia
                        ordine</button>
                </div>
                <div class="row d-flex justify-content-center ">
                    <input id="insert-image" type="file" multiple class="form-control-file" accept="image/*">
                    <label for="insert-image" class="col-5 col-md-3 col-lg-2 button-orange text-uppercase text-center padding-top-10px">
                        Carica immagine</label>
                </div>
            </div>
        </div>
        <!--fine  image input -->

        <!-- inizio campi di testo -->
        <div class="row d-flex justify-content-center">
            <div class="col-11 col-md-10 col-lg-9 col-xl-8">

                <!-- Title -->
                <div class="row">
                    <div class="col-12">
                        <h6 class="text-center text-uppercase">Titolo</h6>
                        <input type="text" name="eventTitle" class="input input-max-width" id="title" />
                    </div>
                </div>

                <!-- data, ora -->
                <div class="row ">
                    <div class="col-6">
                        <h6 class="text-center text-uppercase">Data</h6>
                        <input type="date" name="eventDate" class="input input-max-width" id="date" />
                    </div>
                    <div class="col-6">
                        <h6 class="text-center text-uppercase">Ora</h6>
                        <input type="time" name="eventTime" class="input pl-3" id="time" />
                    </div>
                </div>

                <!-- locale -->
                <div class="row">
                    <div class="col-12">
                        <h6 class="text-center text-uppercase">Locale</h6>
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
                        <h6 class="text-center text-uppercase">Prezzo</h6>
                        <input type="number" min="0" max="9999.9" step="0.01" name="eventPrice" class="input input-max-width" id="price" onkeydown="return event.keyCode !== 69 && event.keyCode !== 189" />
                        <!-- toglie la e (si usa per l esponenziale) -->
                    </div>
                    <div class="col-7 pl-0">
                        <h6 class="text-center text-uppercase">Stanza</h6>
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
                        <h6 class="text-center text-uppercase">Artista</h6>
                        <input type="text" name="eventArtist" class="input input-max-width" id="artist" />
                    </div>
                </div>

                <!-- Description -->
                <div class="row">
                    <div class="col-12">
                        <h6 class="text-center text-uppercase">Descrizione</h6>
                        <input type="text" name="eventDescription" class="input input-max-width" id="description" />
                    </div>
                </div>

                <!-- submit -->
                <div class="row mt-2">
                    <div class="col-12">
                        <button type="button" onclick="uploadEvent()" class="button-orange">PUBBLICA EVENTO</button>
                    </div>
                </div>
                <div id="hiddenRoom"></div> <!-- room id -->
                <div id="hiddenImage"></div><!-- image data -->
                <div id="hiddenImageNumber"></div> <!-- image numbers -->
            </div>
        </div>
        <!-- fine campi di testo -->
    </form>
</div>


<script>
var changeImageOrder = false;
var imageCount = 0;
var locationData;
var nextSelectedImageNum = 1;
var imgSelected = [];

function changeOrder() {
    if (!changeImageOrder) {
        changeImageOrder = true;
        clearSelectedImage();
        if (imageCount != 0) {
            $(".suggest").append('<p class="col-12 text-center">Clicca sull\'immagine per evidenziarla</p>')
        } else {
            $(".suggest").append('<p class="col-12 text-center">Aggiungi delle immagini</p>')
        }
        $(".suggest").removeClass("hidden");
    } else {
        changeImageOrder = false;
        $(".suggest").empty();
    }
}

function clearSelectedImage() {
    $(".overlay-selected").removeClass("overlay-selected");
    $(".overlay-text-centered").empty();

    nextSelectedImageNum = 1;
    $("#hiddenImageNumber input").val = "-1";
}

function selectImageForRemove(usedDiv) {
    $(".overlay-selected1").removeClass("overlay-selected1");
    usedDiv.children[0].classList.add("overlay-selected1");
}

function clickImage(usedDiv) {
    if (imageCount == 0) {
        return;
    }
    if (!changeImageOrder) {
        selectImageForRemove(usedDiv);
        return;
    }
    if (usedDiv.children[0].classList.contains("overlay-selected")) {
        clearSelectedImage();
    } else {

        usedDiv.children[0].classList.add("overlay-selected");
        usedDiv.children[1].innerHTML = '<p class="text-center overlay-text badge badge-pill badge-dark">' + (
            nextSelectedImageNum) + '</p>'

        //usedDiv.children[1].children[0].innerHTML = nextSelectedImageNum;
        $("#hiddenImageNumber input:nth-child(" + usedDiv.children[0].id.split("-")[1] + ")").val(nextSelectedImageNum);

        nextSelectedImageNum++;
    }
}

function formatImage() {
    var index = 1;
    while ($("#images > .carousel-item:nth-child(" + (index + 1) + ")").length) {
        //console.log($("#images > .carousel-item:nth-child(" + index + ") > div").length);
        //console.log($("#images > .carousel-item:nth-child(" + (index + 1) + ")"));
        while ($("#images > .carousel-item:nth-child(" + index + ") > div").length < 3 &&
            $("#images > .carousel-item:nth-child(" + (index + 1) + ")").length) {

            $("#images > .carousel-item:nth-child(" + (index + 1) + ") > div:nth-child(1)")
                .appendTo($("#images > .carousel-item:nth-child(" + index + ")"));

            //console.log($("#images > .carousel-item:nth-child(" + index + ") > div").length);
            // if empty remove the other group
            if ($("#images .carousel-item:nth-child(" + (index + 1) + ") > div").length == 0) {
                $("#images .carousel-item:nth-child(" + (index + 1) + ")").remove();
            }
        }
        index++;
    }
}

function reselectImage() {
    var indexImage = 1;
    var indexItem = 1;
    var indexDiv;
    while ($("#images .carousel-item:nth-child(" + indexItem + ")").length) {
        indexDiv = 1;
        while ($("#images .carousel-item:nth-child(" + indexItem + ") .overlay-father:nth-child(" + indexDiv + ")")
            .length) {
            $("#images .carousel-item:nth-child(" + indexItem + ") .overlay-father:nth-child(" + indexDiv + ") img")
                .addClass("overlay-selected");
            $("#images .carousel-item:nth-child(" + indexItem + ") .overlay-father:nth-child(" + indexDiv +
                    ") .overlay-text-centered")
                .append('<p class="text-center overlay-text badge badge-pill badge-dark">' + indexImage + '</p>');
            indexImage++;
            indexDiv++;
        }
        indexItem++;
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
                        '<div class="carousel-item active d-flex justify-content-center"></div>');
                    if (changeImageOrder) {
                        $(".suggest").empty();
                        $(".suggest").append(
                            '<p class="col-12 text-center">Clicca sull\'immagine per evidenziarla</p>')
                        $(".suggest").removeClass("hidden");
                    }
                } else {
                    $("#images").append('<div class="carousel-item "></div>');
                }
            }

            $("#images > div:last-child").append(
                '<div class="col-4 float-left overlay-father p-0 pl-2 pr-2 height-200 tag-cri" onclick="clickImage(this)">' +
                '<img id="image-' + (imageCount + 1) +
                '" class="img-fluid overlay-selected cover-100-percent" src="' +
                e.target.result + '" alt="immagine n??' + (imageCount + 1) + '" />' +
                '<div class="overlay-text-centered ">' +
                '<p class="text-center overlay-text badge badge-pill badge-dark">' + (imageCount + 1) + '</p>' +
                '</div>' +
                '</div>');


            imageCount++;
            nextSelectedImageNum++;



            $("#hiddenImage").append(
                '<input type="hidden" name="image' + imageCount + '" value="' + e.target.result + '" >');
            $("#hiddenImageNumber").append(' <input id="imageNumber-' +
                imageCount + '" type = "hidden" name = "imageNumbers[]" value = "' + imageCount + '" > ');

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
            if (changeImageOrder) {
                clearSelectedImage();
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
    $('#createEventCarousel').on('slid.bs.carousel', function() {
        $("#images .justify-content-center").removeClass("d-flex justify-content-center");
        //$("#images .active").addClass("d-flex justify-content-center");
    });
    locationData = $.parseJSON('<?php echo $locationData; ?>');
    changeRoom();
    $("#insert-image").change(function() {
        loadFile(this);
    });
});

function uploadEvent(event) {
    if (imageCount == 0) {
        alert("Non ci sono immagini");
        return;
    }
    if (!$("#title").val().length) {
        alert("Non hai inserito un titolo");
        return;
    }

    if (!$("#date").val().length) {
        alert("Non hai inserito una data");
        return;
    }
    if (!$("#price").val().length) {
        alert("Non hai inserito un prezzo");
        return;
    }
    if (!$("#artist").val().length) {
        alert("Non hai inserito l'artista");
        return;
    }
    if (!$("#description").val().length) {
        alert("Non hai inserito una descrizione");
        return;
    }
    if (nextSelectedImageNum != imageCount + 1) {
        console.log(nextSelectedImageNum + " " + imageCount);
        alert("Non hai ordinato bene le immagini");
        return;
    }
    if (parseFloat($("#price").val()) < 0) {
        alert("Non puoi inserire un prezzo negativo");
        return;
    }
    if (parseFloat($("#price").val()) > 9999) {
        alert("Non puoi inserire un prezzo pi?? alto di 9999");
        return;
    }
    if ((new Date($("#date").val()).getTime() - new Date().getTime()) / (1000 * 60 * 60 * 24) < 2) {
        alert("Non puoi creare un evento a meno di due giorni da oggi");
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


    Array.prototype.forEach.call(document.getElementsByClassName("overlay-selected1"), function(element) {
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
    if (!changeImageOrder) {
        reselectImage();
    }
}
</script>




<!-- aggiunta -->