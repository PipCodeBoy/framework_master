
$(document).ready(function(){
  $('form.ajax').on('submit',function(){

      var that=$(this),
      formURL=that.attr('action'),
      type=that.attr('method'),
      postData=$(that).serialize();
    $.ajax({
        url:formURL,
        data:postData,
        method: type,
        datatype:'json',
       /*beforeSend: function(){
          $('#imgload').show();
          },*/
        success: function(output){ //output és la sortida de la funció loginn del IndexController
          console.log(output);
         // si no exixsteix usuari agafar de cookie
         // i si cookie és numèrica es tracta d'usuari anònim
          if(output){
            var obj=eval('('+output+')');
            var redirect=obj.redirect;
            window.location.href=redirect;
          }

        },
        error: function(){}
    });//END $AJAX

  return false;
  });

  var show_msg=function(str){
      $('.msg').html('<p>'+str+'<p>');
      setTimeout(function(){$('.msg p').hide();},5000);
  };

  $("#openbutton").click(function(){
    $("#box").slideToggle( "slow" );
  });

  $.ajax({
        url:'home/showarticles',
        dataType:'json',
        success: function(dades){loadarticles(dades);},
        error: function(){}
  });

  function loadarticles(dades){
    var str = "";
    var cont = dades.length;
      for (var i=0; i<cont; i++) {
        str+="<div class='article'>";
        str+='<span><i onclick="vote('+dades[i].id_article+',0)" class="fa fa-thumbs-up" aria-hidden="true"></i></span>';
        str+='<span><i onclick="vote('+dades[i].id_article+',1)" class="fa fa-thumbs-down" aria-hidden="true"></i></span>';
        str+='<div id="score'+i+'"></div>';
        str+="<h4>"+dades[i].name+"</h4>";
        str+="<img src='"+dades[i].photo+"'/>";
        str+="<p>"+dades[i].description+"</p>";
        str+="<p>"+dades[i].price+"</p>";
        str+="<div class='map' id='map"+i+"'></div>";
        str+="</div>";
        $("#show").append(str);
        str = "";
        chargemap(dades[i].lat,dades[i].lon,i);
        getVote(dades[i].id_article,i); 
      }
      
      
      
  }

  

  //$("#joder").trigger('click',function(){
  if (document.location.href.search("user")!=-1){
    $.ajax({
        url:'user/showusers',
        dataType:'json',
        success: function(dades){loadusers(dades);},
        error: function(){}
    });
  }

  function loadusers(dades){
    var str = "";
    var cont = dades.length;

    str+='<table class="table table-hover table-bordered">';
    str+='<tr><th>ID</th><th>Name</th><th>Pass</th><th>Email</th><th>Telefono</th><th>Rol</th><th>Delete</th><th>Edit</th></tr>';
      for (var i=0; i<cont; i++) {
        str+="<tr>";
        str+="<td>"+dades[i].id_user+"</td>";
        str+="<td>"+dades[i].username+"</td>";
        str+="<td>"+dades[i].password+"</td>";
        str+="<td>"+dades[i].email+"</td>";
        str+="<td>"+dades[i].phone+"</td>";
        str+="<td>"+dades[i].rol+"</td>";
        str+='<td><a href="#" onclick="deluser('+dades[i].id_user+')">';
          str+='<button type="button" class="btn btn-danger" aria-label="Left Align">';
            str+='<span class="glyphicon glyphicon-trash" aria-hidden="true"></span>';
          str+='</button>';
        str+='</a></td>';
        str+='<td><a href="#" onclick="getedituser('+dades[i].id_user+')">';
        str+='<button type="button" class="btn btn-primary" aria-label="Left Align">';
            str+='<span class="glyphicon glyphicon-edit" aria-hidden="true"></span>';
          str+='</button>';
        str+='</a></td>';
        str+="</tr>";
      }
      $("#showusers").html(str);
  }
});

function deluser(id){

  $.ajax({
    type: 'POST',
    url: 'user/deluser',
    data:{ useriddel: id},
    success:function(msg){
      $("showerrors").html(
        "msg"
      );
    },
    error:function(msg){
      $("showerrors").html(
        "msg"
      );
    },
  });

  location.reload();
}

function getedituser(id){
  $.ajax({
    type: 'POST',
    url: 'user/getedituser',
    data:{ useriddel: id},
    datatype:'json',
    success:function(msg){formedit(msg);},
  });
}

function formedit(dades){
  var json = $.parseJSON(dades);
  var str = "";

        str+="<form>";
          str+='<div class="form-group">';
            str+='<label for="exampleInputEmail1">Nombre: </label>';
            str+='<input type="text" class="form-control" id="nameedit" value="'+json.username+'">';
          str+='</div>';
          str+='<div class="form-group">';
            str+='<label for="exampleInputEmail1">Pass: </label>';
            str+='<input type="text" class="form-control" id="passedit" value="'+json.password+'">';
          str+='</div>';
          str+='<div class="form-group">';
            str+='<label for="exampleInputEmail1">Email: </label>';
            str+='<input type="text" class="form-control" id="emailedit" value="'+json.email+'">';
          str+='</div>';
          str+='<div class="form-group">';
            str+='<label for="exampleInputEmail1">Phone: </label>';
            str+='<input type="text" class="form-control" id="phoneedit" value="'+json.phone+'">';
          str+='</div>';
          str+='<div class="form-group">';
            str+='<label for="exampleInputEmail1">Rol: </label>';
            str+='<input type="text" class="form-control" id="roledit" value="'+json.rol+'">';
          str+='</div>';
          str+='<button type="button" onclick="edituser('+json.id_user+')" class="btn btn-default">Edit</button>';
      str+="</form>";
  $("#showedit").html(str);
}


function chargemap(lat,lon,i){

    new GMaps({
    el: '#map'+i,
    lat: lat,
    lng: lon
    });
  
}
  function pos()
  {
      GMaps.geolocate({
        success: function(position) {
          $('#lat').val(position.coords.latitude);
          $('#lon').val(position.coords.longitude);
        },
        error: function(error) {
          alert('Geolocation failed: '+error.message);
        },
        not_supported: function() {
          alert("Your browser does not support geolocation");
        },
      }); 
  } 

function edituser(id){
  var name= $("#nameedit").val();
  var pass= $("#passedit").val();
  var email= $("#emailedit").val();
  var phone= $("#phoneedit").val();
  var rol= $("#roledit").val();
  var innerid = id;

  $.ajax({
    type: 'POST',
    url: 'user/edituser',
    data:{ name: name, pass: pass, email:email, phone:phone, rol:rol, innerid:innerid}
  });

  location.reload();
}

function vote(art,type){
  $.ajax({
    type: 'POST',
    url: 'user/vote',
    data:{art:art,type:type},
    dataType:'json',
    success:function(msg){sss(msg);}
  });
}

function sss(msg){
  if(msg === 0)
  {
    alert("Gracias por votar");
  }
  else
  {
    alert("No puedes votar mas veces este articulo");
  }
}

function getVote(id,i)
{
  // cnt = i;
  $.ajax({
    type: 'POST',
    url: 'user/getVote',
    data:{id:id},
    dataType:'json',
    success:function(msg){xxx(msg,i);}
  });
}

function xxx(msg,i){
  $('#score'+i).html("Puntuacion positiva: "+msg.pos+"<br>Puntuacion negativa: "+msg.neg);
}