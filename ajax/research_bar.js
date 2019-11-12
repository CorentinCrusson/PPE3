var etatBar = false;

$(document).ready(function(){
    $('#search-video').keyup(function(){
      etatBar = true;

      $('#result-search').html('');

      var video = $(this).val();

      var formData = {
        "video" 					: video,
        "type"					: $_GET(['vue']),
      };

      if(video != ""){
        $.ajax({
          type: "POST",
          url: './Modeles/Search.php',
          data:formData,

          success: function(data){
            if(data != ""){
              $('#result-search').append(data);
            }else{
              document.getElementById('result-search').innerHTML = "<div style='color:white; font-size: 20px; text-align: center; margin-top: 10px'>Aucune Vidéo</div>"
            }
          },
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

  function $_GET(param) {
    return unescape(window.location.search.replace(new RegExp("^(?:.*[&\\?]" + escape(param).replace(/[\.\+\*]/g, "\\$&") + "(?:\\=([^&]*))?)?.*$", "i"), "$1"));

  }
