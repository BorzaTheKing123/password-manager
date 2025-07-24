# Generiranje gesel z slovenskimi frazami

## Datoteke

Postopek deluje s pomočjo dveh datotek. Prva vsebuje algoritem, ki ustvari geslo, druga pa JSON datoteko z slovenskimi besedami.

## Delovanje

### Input

Vhodne enote so sestavljene iz:

- vrednosti oziroma domene, ki predstavlja neke vrste uporabniško ime
- soli s katero se to enosmerno enkriptira
- in števila, ki pove koliko slovenskih besed naj je v geslu

### Output

Program izpiše ven geslo iz določenega števila slovesnkih besed, ki so ločene z znaki ali številkami.

### Postopek

Program s pomočjo **hash_pbkdf2(**string _$vrednost_, string _$sol_, int _$iteracije_, int _$dolžina_**)** generira šestanjstiško število s pomočjo katerega se pridobi podatke iz baze.

_$iteracije je po default nastavljena 600000 in nam pove koliko notranjih iteracij bo program izvedel da dobi vrednost._

**_$dolžina_**

_$dolžina_ hash-a je odvisna od tega koliko besed želimo v geslu in koliko besed je v datoteki JSON.

_$factor = intval(ceil(log($elementCount, 2) / 4));_

_$length = $factor\*$this->num;_

_$elementCount_ => število besed v JSON datoteki

_$this->num_ => število besed, ki jih hočemo v geslu

S pomočjo log<sub>2</sub>_$elementCount_ zvemo, da za zapis vseh mest JSON datoteko potrebujemo nekoliko več ko 11b. Ko delimo to vrednost s 4 in jo zaokrožimo navzgor dobimo število šestnajstiških števil s katerimi lahko zapišemo ta mesta kar je 3. Ker pa s tem zapisu lahko dobimo tudi mesta, ki so zunaj nastavljenih indeksov, v tem primeru te vredonsti odštejemo dolžino seznama in in uporabimo nov indeks, ki je gotovo v seznamu.

Pri tem lahko tudi opazimo, da je končni rezultat ne samo odvisen od _$soli_ in od _$vrednosti_, ampak tudi od razporeditve besed v JSON datoteki.

Podoben postopek velja tudi za znake. Znakov je za eno mesto manj kot je besed in se v geslu nahajajo med besedami. Za vključitev se generira krajša koda, ki se jo nato uporabi, da se izbere iz pravilnih indeksov znake.
