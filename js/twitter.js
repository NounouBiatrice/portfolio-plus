var showTweets = function (res) {
  if (res && !res.error) {
    var $tweets = $("#plugin-twitter");
    $tweets.empty();
    $.each(res, function (i, tw) {
      var $li = $(document.createElement("li"))
        , $cite = $(document.createElement("cite"))
        , $author = $(document.createElement("a"))
        , $p = $(document.createElement("p"))
        , $d = $(document.createElement("p"))
        , img = new Image ()
        , tmp = tw.text;
      $author
        .attr("href", "http://twitter.com/" + tw.user.screen_name)
        .text("@" + tw.user.screen_name)
        .appendTo($cite);
      tmp = tmp.replace( // URIs
        /(https?:\/\/[^\s:]+)/gi,"<a href=\"$1\">$1</a>"
      );
      tmp = tmp.replace( // mentions 
        /(@(\w+))/g, "<a href=\"http://twitter.com/$2\">$1</a>"
      );
      tmp = tmp.replace( // trends
        /(\#(\w+))/g,
        "<a class=\"trend\" href=\"http://search.twitter.com/search?q=%23$2\">$1</a>"
      );
      $p.html(tmp);
      img.src = tw.user.profile_image_url;
      img.width = img.height = 40;
      $d
        .addClass("tweetdate")
        .text(tw.created_at.replace(" +0000", ""));
      $li
        .append(img)
        .append($cite)
        .append($p)
        .append($d)
        .appendTo($tweets);
    });
  }
}

$.getJSON("plugins/twitter.php", showTweets);
