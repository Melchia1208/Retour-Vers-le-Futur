<?php


class TimeTravel
{
    private $start;
    private $end;

    public function __construct($start,$end)
    {
        $this->start = $start;
        $this->end = $end;
    }


    public function getTravelInfo()
    {
        $travelTime = $this->start->diff($this->end);
        return $travelTime->format('Il y a %Y années, %M mois, %d jours, %h heures, %i minutes, et %s secondes entre les deux dates');
    }

    public function findDate($interval)
    {

        $dateFind = $this->end->modify('-' . $interval . ' seconds');
        return $dateFind->format('d M Y');
    }

    public function backToTheFuture($back)    {

        $interval = new DateInterval('P1M8D');
        $dateRange = new DatePeriod($this->end, $interval, $back);
        foreach ($dateRange as $date) {
            echo $date->format('M : d : Y : H : i') . '<br/>';
        }

    }
}

$start = new DateTime;
$start->setDate(1954, 04, 23);
$start->setTime(22, 13, 20);
$end = new DateTime;
$end->setDate(1985, 12, 31);
$end->setTime(00, 00, 00);

$date = $end;
$travel = new TimeTravel($start,$end);
echo $travel->getTravelInfo().'<br>';
echo 'Le Doc a voyagé jusqu\'au ' . $travel->findDate(1000000000).'<br>';


$back = new DateTime;
$back->setDate(1985, 12, 31);
$back->setTime(00, 00, 00);
$travel->backToTheFuture($back);


?>

