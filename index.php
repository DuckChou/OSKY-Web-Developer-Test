  <?php


  // read and parse the download json file
  $json_string = file_get_contents('./data.json');

  // create a array for readed json string
  $data = json_decode($json_string, true);


  // sort data array in ASC according to title alphabetically
  array_multisort(array_column($data, 'title'), SORT_ASC, $data);



  // function for adding tag to the string
  // arg1: tag array added to the string (e.g. ["<p>","</p>"])
  // arg2: modified string
  function addTag($tagArray, &$str)
  {
    // check if string already exsits the tag
    if (strcmp(substr($str, 0, strlen($tagArray[0])), $tagArray[0]) != 0) {
      $str = $tagArray[0] . $str . $tagArray[1];
    }
  }

  // function for parse the date string
  // arg: date string
  function parseDate(&$dateStr)
  {
    $date = explode(' ', $dateStr);


    // process day of the week
    switch ($date[0]) {
      case "Mon,":
        $date[0] = "Monday,";
        break;
      case "Tue,":
        $date[0] = "Tuesday,";
        break;
      case "Wed,":
        $date[0] = "Wednesday,";
        break;
      case "Thur,":
        $date[0] = "Thursday,";
        break;
      case "Fri,":
        $date[0] = "Friday,";
        break;
      case "Sat,":
        $date[0] = "Saturday,";
        break;
      case "Sun,":
        $date[0] = "Sunday,";
        break;
    }


    // process st,nd,rd and th
    switch (substr($date[1], 1, 1)) {
      case "1":
        $date[1] = $date[1] . "st";
        break;
      case "2":
        $date[1] = $date[1] . "nd";
        break;
      case "3":
        $date[1] = $date[1] . "rd";
        break;
      default:
        $date[1] = $date[1] . "th";
    }



    // process the month
    switch ($date[2]) {
      case "Jan":
        $date[2] = "January";
        break;
      case "Feb":
        $date[2] = "February";
        break;
      case "Mar":
        $date[2] = "Marth";
        break;
      case "Apr":
        $date[2] = "April";
        break;
      case "May":
        $date[2] = "May";
        break;
      case "Jun":
        $date[2] = "June";
        break;
      case "Jul":
        $date[2] = "July";
        break;
      case "Aug":
        $date[2] = "Augest";
        break;
      case "Sep":
        $date[2] = "September";
        break;
      case "Oct":
        $date[2] = "October";
        break;
      case "Nov":
        $date[2] = "November";
        break;
      case "Dec":
        $date[2] = "December";
        break;
    }



    // process the time
    $time = explode(':', $date[4]);
    if (intval($time[0]) >= 12) {
      $date[4] = $time[0] . ':' . $time[1] . ' ' . "pm";
    } else {
      $date[4] = $time[0] . ':' . $time[1] . ' ' . "am";
    }


    $dateStr = $date[0] . " " . $date[1] . " of " . $date[2] . " " . $date[3] . " " . $date[4];
  }


  // function for parse and print the link attribute
  function printLink($link)
  {

    if (strcmp(gettype($link), "string") == 0) {
      if (strcmp(substr($link, 0, 4), "http") == 0) {
        echo "<a" . ' href="' . $link . '"' . ">" . "Read More" . "</a>";
      }
    } else {
      if (strcmp(substr($link[0], 0, 4), "http") == 0) {
        echo "<a" . " href=" . $link[0] . ">" . "Read More" . "</a>";
      }
    }
  }

  // function for printing the news items
  // arg: array of news item
  function printItems($data)
  {
    foreach ($data as $x) {

      $title = $x["title"];
      $link = $x["link"];
      $description = $x["description"];
      $date = $x["pubDate"];

      addTag(["<h2>", "</h2>"], $title);
      parseDate($date);


      addTag(["<i>", "</i>"], $date);
      addTag(["<p>", "</p>"], $date);

      addTag(["<p>", "</p>"], $description);

      echo "<div>";
      echo $title;
      echo $description;
      printLink($link);
      echo $date;
      echo "</div>";
    }
  }

  
  printItems($data);





  ?>


  <!-- introduce jQuery by google MDN -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

  <!-- introduce index.js from same directory -->
  <script src="index.js" charset="utf-8"></script>