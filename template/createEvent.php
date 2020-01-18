<div class="col-11">
    <div class="row contenuti">


        <!-- image input -->



        <div class="col-12">
            <input type="file" class="form-control-file" accept="image/*" onchange="loadFile(event)">
            <div id="createEventCarousel" class="carousel slide" data-ride="carousel">
                <ol class="carousel-indicators">
                    <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                    <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                </ol>
                <div id="images" class="carousel-inner" role="listbox">
                    <div class="carousel-item row no-gutters active">
                        <div class="col-3 float-left"><img class="img-fluid"
                                src="http://placehold.it/400x400/222/fff?text=1">
                        </div>
                        <div class="col-3"><img class="img-fluid" src="http://placehold.it/400x400/444?text=2"></div>
                        <div class="col-3"><img class="img-fluid" src="http://placehold.it/400x400/888?text=3"></div>
                        <div class="col-3"><img class="img-fluid" src="http://placehold.it/400x400/111/fff?text=4">
                        </div>
                    </div>
                    <div class="carousel-item row no-gutters">
                        <div class="col-3"><img class="img-fluid" src="http://placehold.it/400x400/222/fff?text=5">
                        </div>
                        <div class="col-3"><img class="img-fluid" src="http://placehold.it/400x400/444?text=6"></div>
                        <div class="col-3 "><img class="img-fluid" src="http://placehold.it/400x400/888?text=7"></div>
                        <div class="col-3"><img class="img-fluid" src="http://placehold.it/400x400/111/fff?text=8">
                        </div>
                    </div>
                    <!--<div class="carousel-item active">
                                    <div class="col-4">
                                        <div class="card card-body">
                                            <img class="img-thumbnail w-100" src="img/locandina.jpg" />
                                        </div>
                                    </div>
                                </div> -->
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
</div>
<!-- Title -->
<div class="row">
    <div class="col-12">
        <input type="title" name="eventTitle" placeholder="Titolo" class="input input-max-width" id="title" />
    </div>
</div>

<!-- data, locale -->
<div class="row ">
    <div class="col-5 mr-0">
        <input type="date" name="eventDate" placeholder="Date" class="input input-max-width" id="data" />
    </div>
    <div class="col-7 ml-0">
        <input type="place" name="eventPlace" placeholder="Luogo" class="input input-max-width" id="place" />
    </div>
</div>

<!-- prezzo, sala -->
<div class="row">
    <div class="col-5 mr-0">
        <input type="price" name="eventPrice" placeholder="Price" class="input input-max-width" id="price" />
    </div>
    <div class="col-7 ml-0">
        <input type="room" name="eventRoom" placeholder="Stanza" class="input input-max-width" id="room" />
    </div>
</div>

<!-- Artista -->
<div class="row">
    <div class="col-12">
        <input type="artist" name="eventArtist" placeholder="Artista" class="input input-max-width" id="artist" />
    </div>
</div>

<!-- Title -->
<div class="row">
    <div class="col-12">
        <input type="title" name="title" placeholder="Descrizione" class="input input-max-width" id="description" />
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


<script>
var firstImage = true;
var loadFile = function(event) {

    if (firstImage) {
        $("#images img").first().attr('src', URL.createObjectURL(event.target.files[0]));
        firstImage = false;
        return;
    } else {
        $("#images").append(
            '<div class="carousel-item"> <div class="col-4"> <div class="card card-body"><img class="img-thumbnail" src="' +
            URL.createObjectURL(event.target.files[0]) + '" /></div></div></div>');
    }
    var img = $("#images img:last-child");
    console.log(img.width() + " " + img.height())
    if (img.width() / img.height() > 1.7 || img.width() / img.height() < 0.8 || img.height() > 400 || img.height() <
        300) {
        alert("Image size not supported (4/3 or 1/1, height = (300 - 400)");
        return;
    }

}
$(document).ready(function() {
    $('.carousel').carousel({
        interval: 2000000
    })
});
</script>