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
                    <a class="carousel-control-prev" href="#createEventCarousel" onclick="tmp()" role="button"
                        data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#createEventCarousel" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
                <div class="row mb-1 d-flex justify-content-center">
                    <button class="button-red col-5 text-uppercase mr-2">Rimuovi selezionati</button>
                    <button class="button-orange col-6 text-uppercase">Imposta come principale</button>
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
                <input type="title" name="eventTitle" placeholder="Titolo" class="input input-max-width" id="title" />
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
                <input type="price" name="eventPrice" placeholder="Price" class="input input-max-width" id="price" />
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
                <input type="title" name="eventDescription" placeholder="Descrizione" class="input input-max-width"
                    id="description" />
            </div>
        </div>

        <!-- go to singUp page -->
        <div class="row">
            <div class="col-12">
                <input type="submit" value="PUBBLICA EVENTO" name="submit" class="button-orange" />
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

function clearSelectedImage() {
    $(".overlay-selected").removeClass("overlay-selected");
    $(".overlay-text-centered").empty();
    nextSelectedImageNum = 1;
}

function clickImage(usedDiv) {
    console.log(usedDiv.children);
    if (usedDiv.children[0].classList.contains("overlay-selected")) {
        clearSelectedImage();
        console.log("I'm here");
    } else {
        usedDiv.children[0].classList.add("overlay-selected");
        usedDiv.children[1].innerHTML = nextSelectedImageNum;
        nextSelectedImageNum++;
    }
}

function tmp(event) {
    console.log(event);
}

var loadFile = function(event) {
    if (event.files && event.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {

            if (imageCount % 3 == 0) {
                if (imageCount == 0) {
                    $("#images").empty();
                    $("#images").append(
                        '<div class="carousel-item row d-flex justify-content-center active"></div>');
                } else {
                    $("#images").append('<div class="carousel-item row  "></div>');
                }
            }

            $("#images > div:last-child").append(
                '<div class="col-4 float-left overlay-father pl-0" onclick="clickImage(this)"><img class="img-fluid" src="' +
                e
                .target.result + '" alt="immagine n°' + (imageCount + 1) +
                '" /><div class="overlay-text-centered"></div></div>');;

            imageCount++;



            $("#hiddenImage").append(
                '<input type="hidden" name="image' + imageCount + '" value="' + e.target.result + '" >');

            var img = $("#images img:last-child");
            console.log(img.width() + " " + img.height());
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
    locationData = $.parseJSON('<?php echo $locationData; ?>');
    changeRoom();
    $("#insert-image").change(function() {
        loadFile(this);
    });
});

var uploadEvent = function(event) {
    console.log("here");
    if (firstImage || !$("#title").length || !$("#date").length ||
        !$("#price").val.length || !$("#artist").length || !$("#description").length) {
        console.log("not all element " + !$("#data").length + $("#date"));
        return;
    }
    /*
    print_r($dbh->createEvent($_POST["sessionId"], $_POST["description"],
    $_POST["artist"], $_POST["price"], $_POST["date"], $_POST["idRoom"]));
    */



    /*$.post("phpFunctions/newEvent.php", {
        name: $("#title").val(),
        description: $("#description").val(),
        artist: $("#artist").val(),
        price: $("#price").val(),
        date: $("#date").val(),
        idRoom: locationData[$("#place").val()][$("#room").val()],
    }, function(data) {
        console.log("createEvent: result = " + data);
    })*/
    console.log(locationData[$("#place").val()][$("#room").val()]);

}


var changeRoom = function() {
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
</script>