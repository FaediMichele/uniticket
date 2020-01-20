<div class="col-11">
    <div class="row contenuti">
        <form id="form-addEvent" action="phpFunctions/newEvent.php" method="POST" enctype="multipart/form-data">

            <!-- image input -->
            <div class="row">
                <div class="col-12">
                    <input id="insert-image" type="file" multiple class="form-control-file" accept="image/*">
                    <div id="createEventCarousel" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                        </ol>
                        <div id="images" class="carousel-inner">
                            <!-- do not remove this image, only change the src -->
                            <div class="carousel-item active">
                                <img class="img-thumbnail w-100" id="imgPreview" src="img/locandina.jpg" />
                            </div>
                            <!-- other image will be added here -->
                        </div>
                        <a class="carousel-control-prev" href="#createEventCarousel" role="button" data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#createEventCarousel" role="button" data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row form-group"> </div>
            <!-- Title -->
            <div class="row">
                <div class="col-12">
                    <input type="title" name="eventTitle" placeholder="Titolo" class="input input-max-width"
                        id="title" />
                </div>
            </div>

            <!-- data, locale -->
            <div class="row ">
                <div class="col-6 mr-0">
                    <input type="date" name="eventDate" placeholder="Date" class="input input-max-width" id="date" />
                </div>
                <div class="col-6 ml-0 input">
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

            <!-- prezzo, sala -->
            <div class="row">
                <div class="col-5 mr-0">
                    <input type="price" name="eventPrice" placeholder="Price" class="input input-max-width"
                        id="price" />
                </div>
                <div class="col-7 ml-0 input">
                    <select class="form-control" onChange="roomSelected()" id="room">
                        <!-- room will be added here by client -->
                    </select>
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

        </form>
    </div>
</div>


<script>
var imageCount = 0;
var locationData;

var loadFile = function(event) {
    if (event.files && event.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
            if (imageCount == 0) {
                $("#images").empty();


                // change the active on carouse-item
                $("#images").append(
                    '<div class="carousel-item card card-body active"><img class="img-thumbnail" alt="immagine dell evento" src="' +
                    e.target.result + '" /></div>');
            } else {
                $("#images").append(
                    '<div class="carousel-item card card-body"><img class="img-thumbnail" alt="immagine dell evento" src="' +
                    e.target.result + '" /></div>');
            }
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