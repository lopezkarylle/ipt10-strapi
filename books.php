<?php
include "vendor/autoload.php";
use GuzzleHttp\Client;

function getBooks() {
    $token = 'c6b3a6ebc166dadbccf6b34642018ea7ec10368ceb82039cc0fb84c97fa9cab1dd699d12b58931e9b06ece534d63cc81645396de6c46832819d4ef73e9db74d74d1c3f62e0ee71c0ab510b337d344352348462c4973cf7476154366265d682eafd7691390e3fed581f7ca98952bc97c650d9fa28afe56832bb87029e32757c6f';

    $client = new Client([
        'base_uri' => 'http://localhost:1337/api/'
    ]);

    $headers = [
        'Authorization' => 'Bearer ' . $token,        
        'Accept'        => 'application/json',
    ];

    $response = $client->request('GET', 'books?pagination[pageSize]=66', [
        'headers' => $headers
    ]);

    $body = $response->getBody();
    $decoded_response = json_decode($body);
    return $decoded_response;
}


$books = getBooks();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>IPT10 Scriptures Activity</title>
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round|Open+Sans">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style>
    body {
        color: #404E67;
        background: #F5F7FA;
		font-family: 'Open Sans', sans-serif;
	}
	.table-wrapper {
		width: 1000px;
		margin: 30px auto;
        background: #fff;
        padding: 20px;	
        box-shadow: 0 1px 1px rgba(0,0,0,.05);
    }
    .table-title {
        padding-bottom: 10px;
        margin: 0 0 10px;
    }
    .table-title h2 {
        margin: 6px 0 0;
        font-size: 22px;
    }
    table.table {
        table-layout: fixed;
    }
</style>

</head>
<body>
    <div class="container">
        <div class="table-wrapper">
            <div class="table-title">
                <div class="row">
                    <div class="col-sm-8"><h2>Scriptures <b>Book</b></h2></div>
                </div>
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <td><b>ID</b></td>
                        <td><b>Name</b></td>
                        <td><b>Author</b></td>
                        <td><b>Category</b></td>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                        foreach ($books->data as $bookData){
                        $book = $bookData->attributes;
                        ?>
                        <tr>
                        <th scope = "row"><?php echo $bookData-> id;?></th>
                        <td><?php echo $book-> name;?></td>
                        <td><?php echo $book-> author;?></td>
                        <td><?php echo $book-> category;?></td>
                        </tr>
                    <?php }?>
                </tbody>
                </table>

            </div>
        </div>        
    </div>     
</body>
</html>