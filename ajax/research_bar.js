var etatBar = false;

$(document).ready(function(){
    $('#search-video').keyup(function(){
      etatBar = true;

      $('#result-search').html('');

      var video = $(this).val();

      if(video != ""){
        $.ajax({
          type: 'GET',
          url: './Modeles/Search.php',
          data:'video=' + encodeURIComponent(video),
          success: function(data){
            if(data != ""){
              $('#result-search').append(data);
            }else{
              document.getElementById('result-search').innerHTML = "<div style='color:white; font-size: 20px; text-align: center; margin-top: 10px'>Aucune Vidéo</div>"
            }
          }
        });
      } else {
        window.location.reload();
      }
    });

    if(etatBar)
    {
      window.location.reload();
    }

  });
