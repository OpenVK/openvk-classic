//<![CDATA[
$(document).ready(function(){

    var cssSelector = {
        jPlayer: "#jquery_jplayer_1", 
        cssSelectorAncestor: "#jp_container_1"
    };

    var playlist = [
        {
            author:"L.B. One",
            title:"Tired Bones (feat. Laenz) [Extended Mix]",
            discription: "Текст песни / описание",
            mp3:"/audio/music/1.mp3",
            oga:"/audio/music/1.mp3"
        }
    ];

    var options = {
        swfPath: "js",
        supplied: "oga, mp3",
        wmode: "window",
        smoothPlayBar: false,
        keyEnabled: true
    };

    new jPlayerPlaylist(cssSelector, playlist, options);
});
//]]>