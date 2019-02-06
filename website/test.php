

<?php
  require_once('mysql_connect.php'); 

  $sql = "SELECT name FROM `Province`";
  $result = $conn->query($sql);

  while($row = $result->fetch_assoc()){
    $categories[] = array("name" => $row['name']);
  }

  $query = "SELECT name, province FROM `City`";
  $result = $conn->query($query);

  while($row = $result->fetch_assoc()){
    $subcats[$row['province']][] = array("name" => $row['name']);
  }
 

  $jsonCats = json_encode($categories);
  $jsonSubCats = json_encode($subcats);



?>

<!docytpe html>
<html>

  <head>
    <script type='text/javascript'>
      <?php
        echo "var subcats = $jsonSubCats; \n";
        echo "var categories = $jsonCats; \n";
        
      ?>


      function loadCategories(){
        
        var select = document.getElementById("categoriesSelect");
        updateSubCats("alberta")
        window.alert(select.constructor.name);
        for(var i = 0; i < categories.length; i++){
          select.options[i] = new Option(categories[i].name); 

        }

      }
      function updateSubCats(val){

        var subcatSelect = document.getElementById("subcatsSelect");
        subcatSelect.options.length = 0; //delete all options if any present
        for(var i = 0; i < subcats[val].length; i++){
          subcatSelect.options[i] = new Option(subcats[val][i].name);
        }
      }
      function GetSelectedTextValue(categoriesSelect) {
        var selectedValue = categoriesSelect.value;
        updateSubCats(selectedValue)
    }
    </script>

  </head>

  <body onload='loadCategories()'>
    <select id='categoriesSelect' onchange="GetSelectedTextValue(this);" >
    </select>

    <select id='subcatsSelect'>
    </select>
  </body>
</html>
