<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <title>My Google API Application</title>
    <script src="https://www.google.com/jsapi?key=ABQIAAAAGpEWenySjkI7QuRAy1fXBxQ9C6UIPEUyl5QKj9tlynWBI2uRZRSTkTEL0sMfbRCRE7oWkY3e8lhSCA" type="text/javascript"></script>
    <script language="Javascript" type="text/javascript">
    //<![CDATA[

    google.load("search", "0");

    function OnLoad() {
      // Create a search control
      var searchControl = new google.search.SearchControl();

      // Add in a full set of searchers
      var localSearch = new google.search.LocalSearch();
     // searchControl.addSearcher(localSearch);
      searchControl.addSearcher(new google.search.WebSearch());
      //searchControl.addSearcher(new google.search.VideoSearch());
     // searchControl.addSearcher(new google.search.BlogSearch());

      // Set the Local Search center point
      localSearch.setCenterPoint("San Jose, Costa Rica");

      // Tell the searcher to draw itself and tell it where to attach
      searchControl.draw(document.getElementById("searchcontrol"));

      // Execute an inital search
     // searchControl.execute("Costa Rica Raw");
    }
    google.setOnLoadCallback(OnLoad);

    //]]>
    </script>
  </head>
  <body>
    <div id="searchcontrol">Loading...</div>
  </body>
</html>