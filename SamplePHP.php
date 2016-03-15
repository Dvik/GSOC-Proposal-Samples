class Event
{
  public $name;
  public $title;
  public $date;
  public $speakers;
 
  function __construct(
    $name, $title, $date, $speakers)
  {
    $this->name = $name;
    $this->title = $title;
    $this->date = $date;
    $this->speakers = $speakers;
  }
}

$Events = array(
  new Event(
    "Event Name 1",
    "Event Title 1",
    "1/13/2019",
    array(
      "Speaker 1",
      "Speaker 2",
      "Speaker 3"
      )
  ),
   
  new Event(
    "Event Name 1",
    "Event Title 1",
    "1/12/2019",
    array(
      "Speaker 1"
    )
  ),
 
  new Event(
    "Event Name 3",
    "Event Title 3",
    "1/6/2019",
    array(
      "Speaker 1",
      "Speaker 2"
    )
  ),
 
  new Event(
    "Event Name 4",
    "Event Title 4",
    "12/12/2019",
    array(
      "Speaker 1"
    )
  )
);

$xmlDoc = new DOMDocument();

$root = $xmlDoc->appendChild(
          $xmlDoc->createElement("Conference"));
       

foreach($Events as $event)
{
  $eventTag = $root->appendChild(
              $xmlDoc->createElement("Event"));
           
  $eventTag->appendChild(
    $xmlDoc->createAttribute("name"))->appendChild(
      $xmlDoc->createTextNode($event->name));
   
  $eventTag->appendChild(
    $xmlDoc->createElement("Title", $event->title));
   
  $eventTag->appendChild(
    $xmlDoc->createElement("Date", $event->date));

  $catTag = $eventTag->appendChild(
              $xmlDoc->createElement("Speakers"));

  foreach($event->speakers as $cat)
  {
    $catTag->appendChild(
      $xmlDoc->createElement("Speaker", $cat));
  }
}

header("Content-Type: text/plain");

$xmlDoc->formatOutput = true;

echo $xmlDoc->saveXML();