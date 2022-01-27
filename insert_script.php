<h3> Insert Script </h3>
Running script...
<?php
include 'connection.php';
$region = array();

$northlandregions = "Whangarei, Marsden Point, Ngunguru, Kawakawa, Kerikeri, Moerewa, Paihia, Russell, Dargaville, Kaikohe, Kaitaia, Mangawhai, Waipu";
$aucklandregions = "North Shore, West Auckland (urban); West Auckland (PO box), North Shore, West Auckland (rural); North Shore (PO Box), Helensville, Kumeu, Hibiscus Coast, Warkworth, Wellsford, Snells Beach, Central Auckland, Waiheke Island (urban),
Waiheke Island (rural), South Auckland (urban, north and east), South Auckland, Pukekohe, Tuakau, Waiuku (urban, south); South Auckland (PO box, north and east), South Auckland (PO box, south), Pukekohe, Tuakau, Waiuku (PO box), Pokeno, Mercer, Mangatawhiri
, South Auckland (rural), Pukekohe, Tuakau, Waiuku (rural)";
$waikatoregions = "";
$bopregions = "";


$Northland = "1, 2, 3, 4, 5";
$Auckland = "6,7,8,9,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24,25,26";
$Waikato = "32,33,34,35,36,37,38";
$BOP = "30,31";
$Gisborne = "40";
$HB = "41,42";
$Taranaki = "43,46";
$MW = "39,44,45,47,48,49,55";
$Wellington = "50,51,52,53,57,58,60,61,62,64,69";
$Tasman = "70,71";
$Marl = "72";
$WC = "78";
$Canterbury = "73,74,75,76,77,79,80,81,82,84,85,85,88,89";
$Otago = "90,92,93,94,95";
$Southland = "96,97,98";



array_push($region, "'Whangarei, Marsden Point, Ngunguru'"
,"'Kawakawa, Kerikeri, Moerewa, Paihia, Russell'"
,"'Dargaville'"
,"'Kaikohe, Kaitaia'"
,"'Mangawhai, Waipu'"
,"'North Shore, West Auckland (urban); West Auckland (PO box)'"
,"'North Shore, West Auckland (rural); North Shore (PO Box)'"
,"'Helensville, Kumeu'"
,"'Hibiscus Coast, Warkworth, Wellsford, Snells Beach'"
,"'Central Auckland, Waiheke Island (urban)'"
,"'Central Auckland (PO box, central)'"
,"'Central Auckland (PO box, western bays)'"
,"'Central Auckland (PO box, inner south-west)'"
,"'Central Auckland (PO box, outer south-west)'"
,"'Central Auckland (PO box, inner south-east)'"
,"'Central Auckland (PO box, outer-south-east)'"
,"'Central Auckland (PO box, eastern bays)'"
,"'Waiheke Island (PO box)'"
,"'Waiheke Island (rural)'"
,"'South Auckland (urban, north and east)'"
,"'South Auckland, Pukekohe, Tuakau, Waiuku (urban, south); South Auckland (PO box, north and east)'"
,"'South Auckland (PO box, south)'"
,"'Pukekohe, Tuakau, Waiuku (PO box)'"
,"'Pokeno, Mercer, Mangatawhiri'"
,"'South Auckland (rural)'"
,"'Pukekohe, Tuakau, Waiuku (rural)'"
,"'unused'"
,"'unused'"
,"'unused'"
,"'Rotorua, Murupara'"
,"'Tauranga, Whakatane, Edgecumbe, Katikati, Kawerau, Opotiki, Te Puke'"
,"'Hamilton, Raglan'"
,"'Taupo, Morrinsville, Te Aroha, Turangi'"
,"'Cambridge, Tokoroa, Mangakino, Matamata, Putaruru'"
,"'Coromandel, Ngatea, Tairua, Thames, Whitianga'"
,"'Paeroa, Waihi, Waihi Beach, Whangamata'"
,"'Huntly, Ngaruawahia, Te Kauwhata'"
,"'Te Awamutu'"
,"'Otorohanga, Taumarunui, Te Kuiti'"
,"'Gisborne, Ruatoria'"
,"'Hastings, Napier, Wairoa'"
,"'Waipawa, Waipukurau'"
,"'New Plymouth, Eltham, Inglewood, Stratford, Waitara'"
,"'Palmerston North'"
,"'Whanganui, Patea'"
,"'Hawera, Ohakune, Opunake, Raetihi'"
,"'Feilding, Marton, Taihape'"
,"'Ashhurst, Bulls, Foxton, Shannon, Waiouru'"
,"'Dannevirke, Pahiatua, Woodville'"
,"'Kapiti, Lower Hutt, Porirua, Upper Hutt (urban); Lower Hutt (PO Box)'"
,"'Upper Hutt (PO Box)'"
,"'Kapiti, Porirua (PO Box)'"
,"'Kapiti, Lower Hutt, Porirua, Upper Hutt (rural)'"
,"'unused'"
,"'Levin, Otaki'"
,"'unused'"
,"'Carterton, Featherston, Greytown, Martinborough'"
,"'Masterton'"
,"'unused'"
,"'Wellington (urban)'"
,"'Wellington (PO box, central & west)'"
,"'Wellington (PO box, south & east)'"
,"'unused'"
,"'Wellington (PO box, north)'"
,"'unused'"
,"'unused'"
,"'unused'"
,"'unused'"
,"'Wellington (rural)'"
,"'Nelson, Richmond, Brightwater, Mapua, Wakefield'"
,"'Motueka, Takaka'"
,"'Blenheim, Picton'"
,"'Cheviot, Kaikoura, Hanmer Springs'"
,"'Rangiora, Amberley, Oxford'"
,"'Akaroa, Darfield'"
,"'Kaiapoi, Leeston, Lincoln, Prebbleton, Rolleston'"
,"'Ashburton, Methven, Rakaia'"
,"'Greymouth, Hokitika, Reefton, Westport'"
,"'Timaru, Geraldine, Temuka, Twizel, Waimate'"
,"'Christchurch (urban)'"
,"'Christchurch (PO Box, central)'"
,"'Christchurch (PO Box, south)'"
,"'unused'"
,"'Christchurch (PO Box, west)'"
,"'Christchurch (PO Box, north)'"
,"'Christchurch (PO Box, central-east)'"
,"'unused'"
,"'Christchurch (PO Box, north-east and south-east)'"
,"'Christchurch (rural and PO Box, rural)'"
,"'Dunedin, Mosgiel, Port Chalmers'"
,"'unused'"
,"'Balclutha, Milton'"
,"'Queenstown, Alexandra, Arrowtown, Cromwell, Ranfurly, Wanaka'"
,"'Oamaru, Palmerston'"
,"'Clinton, Lawrence, Roxburgh, Tapanui'"
,"'Nightcaps, Ohai, Otautau, Tuatapere, Te Anau'"
,"'Gore, Lumsden, Mataura, Winton'"
,"'Invercargill, Bluff, Edendale, Riverton, Wyndham'"
,"'unused'");

//var_dump($region);

for($i = 1; $i < 100 ; $i++){
  echo "Running...";
  $j = $i - 1;
  $query = "INSERT INTO regioncode(code, region) VALUES ($i,$region[$j]);";

  if($conn->query($query) === true) {
    $success_message = "Script successful!";
  } else {
    $error_message = "Script unsuccessful.";
    echo "Error: " . $query . "<br>" . $conn->error;
    echo " Problem in script. Try Again!";
  }
}


?>
