$(document).ready(function(){
    $('#search-video').keyup(function(){
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
              document.getElementById('result-search').innerHTML = "<div style='font-size: 20px; text-align: center; margin-top: 10px'>Aucune Vidéo</div>"
            }
          }
        });
      }
    });
  });
