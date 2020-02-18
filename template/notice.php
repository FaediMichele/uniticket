<div class="col-11 contenuti">
    <div class="row inline-block" id="notices">
        <div id="noticeContainer" class="col-12 container">
            <!-- inzio contenitore  -->


            <!-- contenitore naed -->
        </div>
    </div>
</div>


<script>
function readNotice(element, idEvent, noticeRead) {
    if (noticeRead == 0) {
        console.log("già letto");
        return;
    }
    $.post("phpFunctions/noticeRead.php", {
        "idEvent": idEvent
    }, function(data) {
        var n = parseInt($("#numNotice p").text()) -
            parseInt(element.children[0].children[0].children[2].children[0].children[1].children[0].children[0].innerHTML);
        if (n == 0) {
            $("#numNotice").remove();
        } else {
            $("#numNotice p").html(n);
        }
        element.children[0].children[0].children[2].children[0].children[1].remove();
        var attr = element.getAttributeNode("onclick");
        element.removeAttributeNode(attr);
    });
}

$(document).ready(function() {
    $.post("phpFunctions/getNotice.php", {}, function(data) {
        if (data != "0") {
            $("#noticeContainer").empty();
            console.log(data);
            $("#noticeContainer").html(data);
        }
    });
    setTimeout(function() {
        timeout();
    }, 5000);
});

function timeout() {
    $.post("phpFunctions/isNewNotice.php", {}, function(data) {
        console.log(data);
        if (data != "0") {
            $.post("phpFunctions/getNotice.php", {}, function(data) {

                if (data != "0") {
                    $("#noticeContainer").empty();
                    console.log(data);
                    $("#noticeContainer").html(data);
                }
            });
        }
    });
    setTimeout(function() {
        timeout();
    }, 5000);
}
</script>