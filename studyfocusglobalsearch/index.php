<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Global Search | studyfocus</title>
    <script>window.onload = function () {document.getElementById('text').focus();}</script></head>
</head>
<body>
 <a href="/studyfocus/home"> <img class="logo" src="/studyfocus/logo.png"></a>
    <div class="search">
        <form action="index.php" method="get">
            <input type="text" name="query" id="text" placeholder="Search..."
                value="<?php if (isset($_GET['query'])) {
                    $qur = $_GET['query'];
                    echo $qur;
                } ?>" required>
            <button type="submit">Search</button>  
        </form><br>
    </div>
    <div class="search-results">
        <?php
        if (isset($_GET['query'])) {
            $query = htmlspecialchars($_GET['query']);
            $apiKey = 'AIzaSyCWKoIATxvl3bcx_hxZq-nnWxUw9OgRBHM';
            $cx = 'e00851a5eb7ad4eef';
            $num = 10;
            $start = isset($_GET['start']) ? (int) $_GET['start'] : 1;
            $url = "https://www.googleapis.com/customsearch/v1?key=$apiKey&cx=$cx&q=" . urlencode($query) . "&num=$num&start=$start";
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            $response = curl_exec($ch);
            curl_close($ch);
            $data = json_decode($response, true);
            if (isset($data['items'])) {
                echo "<div class='search-results'>";
                echo "<ul>";
                foreach ($data['items'] as $item) {
                    echo "<li>";
                    echo "<h3><img src='https://t1.gstatic.com/faviconV2?client=SOCIAL&type=FAVICON&fallback_opts=TYPE,SIZE,URL&url=" . $item['link'] . "'></h3>
                  <h3><a href='" . $item['link'] . "' target='_blank'>" . $item['title'] . "</a></h3>
                  <p>" . $item['snippet'] . "</p>
                  </li>";
                }
                echo "</ul>";
                echo "</div>";
                $totalResults = $data['searchInformation']['totalResults'];
                $nextstart = $start + 10;
                $prevstart = $start - 10;
                echo "<div class='pagination'>";
                if ($start > 1) {
                    echo "<button onclick='prv()'>Previous</button>
                    <script> function prv(){ location.replace('?query=" . urlencode($query) . "&start=$prevstart'); } </script>";
                }
                if ($nextstart <= $totalResults) {
                    echo "<button onclick='nxt()'>Next</button>
                          <script> function nxt(){ location.replace('?query=" . urlencode($query) . "&start=$nextstart'); } </script>";
                }
                echo "</div>";
            } else {
                echo "<p style='margin-top:100px;'>No results found for: " . $query . "</p>";
            }
        }
        ?>
    </div>
    <style>
        .pagination {
            margin-left: 20px;
            padding: 10px;
        }
        .pagination button {
            padding: 6px 24px;
            margin-left: 5px;
            text-decoration: none;
            background-color: #1DB5BE;
            color: black;
            border: none;
            cursor: pointer;
        }
        .pagination button:hover {
            color: white;
        }
        .search-results {
            width: 85%;
            margin-top: 75px;
        }
        .search-results ul {
            list-style: none;
        }
        .search-results img {
            padding: 2px;
        }
        .search-results h3 {
            font-size: 22px;
            display: inline-block;
            padding: 3px;
        }
        .search-results p {
            margin-top: -10px;
            margin-left: 35px;
        }
        body {
            font-family: Arial, sans-serif;
            user-select: none;
            background-color: black;
            color: white;
            background : linear-gradient(271deg, #1DB5BE -28.59%, #000 64.27%);
        }
        .search {
            padding: 20px;
            text-align: center;
            position: fixed;
            width: 100%;
            margin-left:40px;
            margin-top:-17px;
            top: 0; 
            left: 0;
            right: 0;
            border: none;
            background : linear-gradient(271deg, #1DB5BE -28.59%, #000 64.27%);
            

        }
        .search input[type=text] {
            font-size: 18px;
            border: 1px solid #1DB5BE;
            padding: 4px 22px;
            width: 78%;
            margin-top:30px;
            background-color: white;
            transition: 0.5s;
            color: black;
            outline: none;
            letter-spacing: 0.5mm;
            float:left;
            margin-left:80px;
            border-radius: 12px 0px 0px 12px ;
        }
        .search button {
            cursor: pointer;
            font-size: 18px;
            margin-top:30px;
            background : #1DB5BE;
            border: 1px solid black;
            border: 1px solid transparent;
            padding: 4px 22px;
            display:inline-block;
            float:left;
            border-radius: 0px 12px 12px 0px;
        }
        .search button:hover{
            background : linear-gradient(271deg, #1DB5BE -28.59%, #000 64.27%);
            color: white;
            border: 1px solid #1DB5BE;
        }
        a{
            color: #1DB5BE;
        }
        a:hover{ 
        }
        .logo{
            position:fixed;
            height:210px;
            margin-top:-130px;
            margin-left:-50px;
            z-index:1;
        }
    </style>
    </body>
</html>