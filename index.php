<?php
include "vendor/autoload.php";
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

$client = new Client();
$headers = [
  'Authorization' => 'wKSrqv4ffU7O7h9gNhb83osan7ctHsvn'
];
$request = new Request('GET', 'https://ipt10-2022.mantishub.io/api/rest/issues?page_size=10&page=1', $headers);
$res = $client->sendAsync($request)->wait();
$bugs = $res->getBody()->getContents();
$bugs_list = json_decode($bugs);

#foreach ($bugs_list->issues as $bug)
#{
#	echo '<li>' . $bug->id . ' ' .
#$bug->summary . ' - ' .
#$bug->severity->name . ' - ' .
#$bug->status->name . "\n";
#}

?>

<!DOCTYPE html>
<html>
<head>
<title>IPT10 Bugs</title>
<style> table, th, td {
  border: 1px solid black;
  border-collapse: collapse;
}
</style>
<style> tr:nth-child(even) {
  background-color: #D6EEEE;
}
</style>
</head>
<body>

<h1>IPT10 Bugs List</h1>
<p><a href="">Stephanie Diaz Basilio</a></p>

<table style= "width: 55%">
  <tr>
    <th>ID</th>
    <th>Summary</th>
    <th>Severity</th>
    <th>Status</th>
  </tr>

  <?php
  foreach ($bugs_list->issues as $bug)
  {
    ?>
  <tr>
    <td><?php echo $bug->id; ?></td>
    <td><?php echo $bug->summary; ?></td>
    <td><?php echo $bug->severity->name; ?></td>
    <td><?php echo $bug->status->name; ?></td>
  </tr>
  <?php
  }
  ?>

</table>

</body>
</html>