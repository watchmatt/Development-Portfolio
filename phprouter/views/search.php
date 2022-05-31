<?php
declare(strict_types=1);
if (basename($_SERVER['SCRIPT_NAME']) == basename(__FILE__))
{
   header('Location: /mwatchman6/phprouter');
}
echo "<h1>Search Page</h1>";
$options = explode('/',$pathvars);
# if not already validated should be 
# print_r($options);
if ($options[0] == "byauthor")
{
	echo "Do search by authur";
}
elseif ($options[0] == "bytitle")
{
	echo <<< _ENDOFFORM_
	<form method="get" action="titleresults">
	<label for = "title">Title to Search for:</lable>
	<input type = "text" name = "titlesearch" id = "title" />
	<input type = "submit" name = "search for books" />
	</form>
_ENDOFFORM_;
}
elseif ($options[0] == "byyear")
{
	echo "Do search by year";
}
elseif ($options [0] == "titleresults")
{
	include_once 'inc/booksbytitle.inc.php';
	$booklist = getbooksbytitle($_GET['titlesearch']);
	echo "This is the results of books by title search: ";
	#echo $_GET['titlesearch'];
	echo $booklist;
}
elseif ($options[0] == "byisbn")
{
	echo <<<_ENDOFFORM_
	<form method="get" action="isbnresults">
	<label for = "isbn">ISBN to Search For: </label>
	<input type = "text" name = "isbnsearch" id = "isbn" />
	<input type = "submit" name = "search for book" />
	</form>
_ENDOFFORM_;
	// echo "search by isbn";
}
elseif ($options [0] == "isbnresults")
{
	include_once 'inc/booksbyisbn.inc.php';
	$booklist = getbookbyisbn($_GET['isbnsearch']);
	echo "This is the results of books by isbn search: ";
	echo $booklist;
}
elseif ($options[0] == "authorinfo")
{
	include_once 'inc/authorsbybookid.inc.php';
	$authorbyid = getauthorsbybookid($options[1]);
	echo "Here are the author(s) for the selected book: ";
	echo "<br />";
	echo $authorbyid;
}
elseif ($options[0] == "bookinfo")
{
	include_once 'inc/booksbyid.inc.php';
	include_once 'inc/authorsbybookid.inc.php';
	$bookidinfo = getbookbyid($options[1]);
	echo "This is the info for the selected book with id of $options[1]: ";
	echo $bookidinfo;
	echo '<br />';
	echo "The Authors for the for the selected book are: ";
	$authorbyid = getauthorsbybookid($options[1]);
	echo $authorbyid;
}
else
{
	echo "that is a not a valid search option";
}
?>