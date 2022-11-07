<?php

echo "<a href='/form.php'>Formulaire</a>";

echo "<h1>Test</h1>";

echo "<h2>Version de PHP :</h2>";
system("php -v");

echo "<h2>Version de MySQL :</h2>";
$conn = new PDO('mysql:host=localhost;dbname=projet-symphony-1', "root");
echo $conn->getAttribute(constant("PDO::ATTR_SERVER_VERSION"));

echo "<h2>Table users_test :</h2>";
$sql = 'SELECT * FROM users_test';
foreach ($conn->query($sql) as $row)
{
    echo "User ". $row['id'] . " --> " . $row['lastname'] . " " . $row['firstname'] . "<br>";
}

echo "<h2>Variables dans un tableau :</h2>";
$var1 = "var1";
$var2 = "var2";
$var3 = "var3";
echo "\$var1 = \"var1\";
        \$var2 = \"var2\";
        \$var3 = \"var3\";<br>";
$tab = [$var2, $var3, $var1];
echo "\$tab = [\$var2, \$var3, \$var1];<br>";
foreach ($tab as $var)
{
    echo $var . "<br>";
}

echo "<h2>Comparaisons :</h2>";
$vari1 = "1";
$vari2 = 1;
echo "\$vari1 = \"1\";
        \$vari2 = 1;<br>";

if($vari1 == $vari2)
{
    echo "\$vari1 == \$vari2 : TRUE<br>";
}
else
{
    echo "\$vari1 == \$vari2 : FALSE<br>";
}

if($vari1 === $vari2)
{
    echo "\$vari1 === \$vari2 : TRUE<br>";
}
else
{
    echo "\$vari1 === \$vari2 : FALSE<br>";
}