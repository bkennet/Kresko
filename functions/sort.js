$(document).ready(function(){
  
  $('select').change(function() {

    var sorttype = $("#wind").val();
    var usertype = $("#wind").attr('usertype');
    var ID = $("#wind").attr('categoryID');


    $.ajax({
      url: '../functions/sort.php',
      type: 'POST',
      data: {sort: sorttype, ID: ID, type: usertype},
      dataType: 'JSON'
    })
    .done(function(data) {
        console.log(data);

        $('.gallery').html("");

      for (var i=0; i<data.length; i++){
        $(".gallery").append("<a class='col-md-3' href='items.php?itemID=" + data[i]['itemid'] + "'><div><img src='../images/" + data[i]['filepath'] + "' alt='Item Image'><div class='gridinfo'><h1>" + data[i]['itemname'] + "</h1><h2>" + data[i]['vendorname'] + "</h2><h2 class='catprice'>$" + data[i]['price'] + "</h2></div></div></a>");
      }
    })
    .fail(function(err){
      console.log(err);
      console.log('failure');
    })


    })
  })  
