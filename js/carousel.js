var row = document.getElementById('row');

var tiles = document.getElementsByClassName('tile');
var hoverTile = document.getElementById('hover');

hoverTile.addEventListener('mouseover', function() {
  for (var i = 0; i < 2; i++) {
    var tile = tiles[i];
    tile.classList.add('shiftLeft');
  }

  for (var i = 3; i < tiles.length; i++) {
    var tile = tiles[i];
    tile.classList.add('shiftRight');
  }
});

hoverTile.addEventListener('mouseout', function() {
  for (var i = 0; i < 2; i++) {
    var tile = tiles[i];
    tile.classList.remove('shiftLeft');
  }

  for (var i = 3; i < tiles.length; i++) {
    var tile = tiles[i];
    tile.classList.remove('shiftRight');
  }
});
